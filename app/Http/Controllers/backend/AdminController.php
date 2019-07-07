<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class AdminController extends Controller
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
            $admins = Admin::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
        } else {
            $admins = Admin::where('company_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;
    
        return view('backend.admins.index', ['admins' =>  $admins, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admins.create-admin');
        return view('backend.admins.form', compact('title'));
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
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'type' => 'required',
            'avatar' => 'image'
        ];
        $request->validate($validate);
        $inputs = $request->only(['name', 'email', 'type', 'phone']);
        $inputs['password'] = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            $inputs['avatar'] = $this->upload($request, 'images', 'avatar');
        }
        $admin = Admin::create($inputs);
        if ($admin) {
            return redirect()->route('admins.index')->with('msg', trans('common.saved'));
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
        $title = trans('admins.create-admin');
        $adminData = Admin::find($id);
        return view('backend.admins.form', compact('title','adminData'));
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
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required',
            'avatar' => 'image'
        ];
        $request->validate($validate);
        $inputs = $request->only(['name', 'email', 'type']);
        $inputs['password'] = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            $inputs['avatar'] = $this->upload($request, 'images', 'avatar');
        }
        $admin = Admin::find($id);
        if ($admin->update($inputs)) {
            return back()->with('msg', trans('common.saved'));
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
        Admin::whereId($id)->delete();
        return back();
    }

    public function changePassword()
    {
        return view('backend.change_password');
    }

    public function doChangePass(Request $request)
    {
        $user = Admin::find(auth()->guard('admin')->user()->id);
        $inputs = $request->only(['password']);
        $inputs['password'] = Hash::make($request->password);

        if ($user->update($inputs)) {
            return back()->with('msg', trans('common.saved'));
        }
        return back()->with('msg', trans('common.error'));
    }



    
    
}
