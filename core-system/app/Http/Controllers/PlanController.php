<?php

namespace App\Http\Controllers\backend;

use App\Models\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class PlanController extends Controller
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
        $plans = Plan::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
    } else {
        $plans = Plan::where('company_id', auth()->guard('admin')->user()->id)->get();
    }
    $dateFrom = $request->dateFrom ?? null;
    $dateTo = $request->dateTo ?? null;
        return view('backend.plans.index', ['plans' => $plans, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }

   
    public function create()
    {
        $plans = Plan::all();
        return view('backend.plans.form', compact('plans'));
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
            'name' => 'required',
            'package' => 'required',
            
        ];
        $request->validate($validate);
        
        $inputs = $request->only(['name', 'package']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        
        $plans= Plan::create($inputs);
        if ($plans) {
            return redirect()->route('plans.index')->with('msg', trans('common.saved'));
        }
        return back()->with('msg', trans('common.error'));
    }

    public function edit($id)
    {
        $planData = Plan::find($id);
        
        return view('backend.plans.form', compact('PlanData'));
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
            'name' => 'required',
            'package' => 'required',
            
        ];
        $request->validate($validate);
        
        $inputs = $request->only(['name', 'package']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        
        $plan = Plan::find($id);
        if ($plan->update($inputs)) {
            return redirect()->route('plans.index')->with('msg', trans('common.saved'));
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
        Plan::whereId($id)->delete();
        return back();
    }
}
