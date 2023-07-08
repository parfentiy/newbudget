<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //
    public $sortItems = [
        'noSort' => 'Без сортировки',
        'operation_date' => 'Дата операции',
        'source_account_id' => 'Счет источник',
        'dest_account_id' => 'Счет зачисления',
        'amount' => 'Сумма',
    ];

    public $sortType = [
        'asc' => 'А -> Я',
        'desc' => 'Я -> А',
    ];

    public function showTransactions(Request $request) {
        //dump(request());
        if (!$request->filled('is_set')) {
            if (!$request->is_set) {
                $source_accs = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->groupBy('source_account_id')
                    ->pluck('source_account_id');
                $dest_accs = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->groupBy('dest_account_id')
                    ->pluck('dest_account_id');
                $is_set = false;
                $date_start = now();
                $date_end = now();
                $amount_min = null;
                $amount_max = null;

                $transactions = \App\Models\CashFlow::where('user_id', Auth::user()->id)->get();
                $amount_sum = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->pluck('amount')
                    ->sum();
            } 
        } else {

            if ($request->is_set) {
                $source_accs = $request->source_accs ?? 
                    \App\Models\CashFlow::where('user_id', Auth::user()->id)
                        ->groupBy('source_account_id')
                        ->pluck('source_account_id');
                $dest_accs = $request->dest_accs ?? 
                    \App\Models\CashFlow::where('user_id', Auth::user()->id)
                        ->groupBy('dest_account_id')
                        ->pluck('dest_account_id');
                $is_set = true;
                

                $query = \App\Models\CashFlow::where('user_id', Auth::user()->id);
                $date_start = $request->date_start;
                $date_end = $request->date_end;
                $amount_min = $request->amount_min;
                $amount_max = $request->amount_max;
                if (!is_null($date_start)) $query->whereDate('operation_date', '>=', date($date_start));
                if (!is_null($date_end)) $query->whereDate('operation_date', '<=', date($date_end));
                if (!is_null($amount_min)) $query->where('amount', '>=', $amount_min);
                if (!is_null($amount_max)) $query->where('amount', '<=', $amount_max);
                $query->whereIn('source_account_id', $source_accs);
                $query->whereIn('dest_account_id', $dest_accs);
                //dump(is_null($sort_item));
                $query->orderBy(isset(request()->sort_item) ? request()->sort_item : '', isset(request()->sort_type) ? request()->sort_type : 'asc');
                //$query->orderBy('amount', 'asc');

                $transactions = $query->get();
                $amount_sum = $query->pluck('amount')->sum();
    
            } else {
                $source_accs = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->groupBy('source_account_id')
                    ->pluck('source_account_id');
                $dest_accs = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->groupBy('dest_account_id')
                    ->pluck('dest_account_id');
                $is_set = false;
                $date_start = now();
                $date_end = now();
                $amount_min = null;
                $amount_max = null;

                $transactions = \App\Models\CashFlow::where('user_id', Auth::user()->id)->get();
                $amount_sum = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                    ->pluck('amount')
                    ->sum();
            }
        }

        return view('reports.transactions', [
            'transactions' => $transactions,
            'source_accs' => $source_accs,
            'dest_accs' => $dest_accs,
            'is_set' => $is_set,
            'amount_min' => $amount_min,
            'amount_max' => $amount_max,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'amount_sum' => $amount_sum,
            'sort_items' => $this->sortItems,
            'sort_types' => $this->sortType,
            'sort_item' => request()->sort_item,
            'sort_type' => request()->sort_type,
        ]);
    }
}
