<?php

namespace App\Http\Controllers\backend;

use App\Models\MedicalService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $service = MedicalService::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
    } else {
        $service = MedicalService::where('company_id', auth()->guard('admin')->user()->id)->get();
    }
    $dateFrom = $request->dateFrom ?? null;
    $dateTo = $request->dateTo ?? null;
        return view('backend.services.index', ['services' => $service, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }

   
    public function create()
    {
        $services = MedicalService::all();
        return view('backend.services.form', compact('services'));
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
            'service' => 'required',
            'cost' => 'required',
            
        ];
        $request->validate($validate);
        
        $inputs = $request->only(['service', 'cost']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        
        $services= MedicalService::create($inputs);
        if ($services) {
            return redirect()->route('services.index')->with('msg', trans('common.saved'));
        }
        return back()->with('msg', trans('common.error'));
    }

    public function edit($id)
    {
        $serviceData = MedicalService::find($id);
        
        return view('backend.services.form', compact('serviceData'));
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
            'service' => 'required',
            'cost' => 'required',
            
        ];
        $request->validate($validate);
        
        $inputs = $request->only(['service', 'cost']);
        $inputs['company_id'] = auth()->guard('admin')->user()->id;
        
        $services = MedicalService::find($id);
        if ($services->update($inputs)) {
            return redirect()->route('services.index')->with('msg', trans('common.saved'));
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
        MedicalService::whereId($id)->delete();
        return back();
    }
}
