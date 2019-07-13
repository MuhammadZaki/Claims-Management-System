<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use App\Models\Claim;
use App\Models\MedicalService;
use App\Models\Patient;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $dateFrom = new Carbon($request->dateFrom);
            $dateTo = new Carbon($request->dateTo);
            $claims = Claim::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
        } else {
            $claims = Claim::where('hp_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;

        
        return view('backend.claims.index', ['claims' => $claims, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $services = MedicalService::all();
        return view('backend.claims.form', compact('patients', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $service = MedicalService::find($request->service_id);
        $inputs = $request->only(['patient_id', 'service_id']);
        $inputs['hp_id'] = auth()->guard('admin')->user()->id;
        $inputs['company_id'] = $patient->company->id;
        $inputs['cost'] = $service->cost;
        /** Create a rest api to call domain: composer-rest-server:3000/api/claim **/
        /** POST request to create the claim, wait for response to be 200 else return error from blockchain, and don't proceed **/
        $claim = Claim::create($inputs);
        if ($claim) {
            return redirect()->route('claims.index')->with('msg', trans('common.saved'));
        }
        return back()->with('msg', trans('common.error'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Claim::whereId($id)->delete();
        return back();
    }

    public function claimsForMoney(Request $request)
    {
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $dateFrom = new Carbon($request->dateFrom);
            $dateTo = new Carbon($request->dateTo);
            $claims = Claim::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
        } else {
            $claims = Claim::where('company_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;


        
        return view('backend.claims.money_claims', ['claims' => $claims, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }

    public function confirmPayment($id)
    {
        $claim = Claim::find($id);
        return view('backend.claims.confirm_payment', ['claim' => $claim]);
    }

    public function saveTransaction(Request $request)
    {
        $claim = Claim::find($request->claim_id);
        $claim->status = 'transferred';
        $claim->save();

        $company = Admin::find($claim->company_id);
        $company->credit = $company->credit - $claim->cost;
        $company ->save();

        

        $patient = Patient::find($claim->patient->id);
        $patient->credit = $patient->credit - $claim->cost;
        $patient->save();

        $hp = Admin::find($claim->hp_id);
        $hp->credit += $claim->cost;
        $hp->save();

        $transaction = new Transaction;
        $transaction->patient_id = $patient->id;
        $transaction->service_id = $claim->service_id;
        $transaction->claim_id = $claim->id;
        $transaction->company_id = $claim->company_id;
        $transaction->hp_id = $claim->hp_id;
        $transaction->cost = $claim->cost;
        $transaction->payment_status = 'done';
        $transaction->save();

        return redirect()->route('admin.claims.money')->with('msg', trans('common.saved'));
    }

    public function rejectTransaction(Request $request)
    {
        $claim = Claim::find($request->claim_id);
        $claim->status = 'rejected';
        $claim->save();
        return redirect()->route('admin.claims.money')->with('msg', trans('common.saved'));
    }
}
