<?php

namespace App\Http\Controllers\backend;

use App\Models\Patient;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class PatientController extends Controller
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
            $patients = Patient::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
        } else {
            $patients = Patient::where('company_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;
        
        return view('backend.patients.index', ['patients' => $patients , 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::all();
        return view('backend.patients.form', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = [
            'national_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'plan_id' => 'required'
        ];
        $request->validate($validate);
        $plan = Plan::find($request->plan_id);
        $inputs = $request->only(['national_id', 'name', 'phone', 'plan_id']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        $inputs['credit'] = $plan->package;
        $patient = Patient::create($inputs);
        if ($patient) {
            return redirect()->route('patients.index')->with('msg', trans('common.saved'));
        }
        return back()->with('msg', trans('common.error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patientData = Patient::find($id);
        $plans = Plan::all();
        return view('backend.patients.form', compact('patientData', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = [
            'national_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'plan_id' => 'required'
        ];
        $request->validate($validate);
        $plan = Plan::find($request->plan_id);
        $inputs = $request->only(['national_id', 'name', 'phone', 'plan_id']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        $inputs['credit'] = $plan->package;
        $patient = Patient::find($id);
        if ($patient->update($inputs)) {
            return redirect()->route('patients.index')->with('msg', trans('common.saved'));
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
        Patient::whereId($id)->delete();
        return back();
    }
}
