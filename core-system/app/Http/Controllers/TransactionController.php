<?php

namespace App\Http\Controllers\backend;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;

class TransactionController extends Controller
{

    public function getAdminTransactions(Request $request)
    {
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $dateFrom = new Carbon($request->dateFrom);
            $dateTo = new Carbon($request->dateTo);
            $transactions = Transaction::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('company_id', auth()->guard('admin')->user()->id)->get();
        } else {
            $transactions = Transaction::where('company_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;

        return view('backend.transactions.admin_transactions', ['transactions' => $transactions, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }

    public function getHPTransactions(Request $request)
    {
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $dateFrom = new Carbon($request->dateFrom);
            $dateTo = new Carbon($request->dateTo);
            $transactions = Transaction::whereBetween('created_at', [$dateFrom->format('Y-m-d')." 00:00:00", $dateTo->format('Y-m-d')." 23:59:59"])->where('hp_id', auth()->guard('admin')->user()->id)->get();;
        } else {
            $transactions = Transaction::where('hp_id', auth()->guard('admin')->user()->id)->get();
        }
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;

        return view('backend.transactions.hp_transactions', ['transactions' => $transactions, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
    }
}
