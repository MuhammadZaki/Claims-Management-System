<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DateRangeController extends Controller
{
    function index()
    {
     return view('date_range');
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {
       $data = DB::table('transactions')
         ->whereBetween('created_at', array($request->from_date, $request->to_date))
         ->get();
      }
      else
      {
       $data = DB::table('transactions')->orderBy('date', 'desc')->get();
      }
      echo json_encode($data);
     }
    }
}

?>
