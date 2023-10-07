<?php

namespace App\Http\Controllers;

use App\Models\PlanBudget;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
=======
use App\Models\expenses;
use App\Models\ExpensesType;
use App\Models\User;
use App\Models\Incomes;
use App\Models\IncomesType;
use App\Models\BudgetNote;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Barryvdh\DomPDF\Facade\Pdf;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class ReportsController extends Controller
{
    //
<<<<<<< HEAD
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
        if ($request->filled('is_set') && $request->is_set) {
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

            if ($request->action === 'filterOnMonth') {
                $month = (int)date("m", strtotime(now()));
                $year = (int)date("Y", strtotime(now()));
                $date_start = date('Y-m-d', strtotime($month . '/1/' . $year));
                $date_end = date('Y-m-d',
                    strtotime($month . '/' . cal_days_in_month(CAL_GREGORIAN, $month, $year) . '/' . $year));
            } else {
                $date_start = $request->date_start;
                $date_end = $request->date_end;
            }
            $amount_min = $request->amount_min;
            $amount_max = $request->amount_max;
            if (!is_null($date_start)) $query->whereDate('operation_date', '>=', date($date_start));
            if (!is_null($date_end)) $query->whereDate('operation_date', '<=', date($date_end));
            if (!is_null($amount_min)) $query->where('amount', '>=', $amount_min);
            if (!is_null($amount_max)) $query->where('amount', '<=', $amount_max);
            $query->whereIn('source_account_id', $source_accs);
            $query->whereIn('dest_account_id', $dest_accs);
            $query->orderBy(isset(request()->sort_item) ? request()->sort_item : '', isset(request()->sort_type) ? request()->sort_type : 'asc');

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

    public function showBudgets() {
        if  (is_null(PlanBudget::where('user_id', Auth::user()->id)->first())) {
            return redirect()->back();
        }
        if (!isset(request()->budgetId)) {

            return view('reports.budgets', [
                'budgetId' => $this->getClosestBudget(),
            ]);
        } else {

            return view('reports.budgets', [
                'budgetId' => request()->budgetId,
            ]);
        }
    }

    private function getClosestBudget() {
        $currentMonth=(int)date("m",strtotime(now()));
        $currentYear=(int)date("Y",strtotime(now()));
        $futureBudgets = PlanBudget::where('user_id', Auth::user()->id)->orderBy('year')->orderBy('month')->get();

        $closestBudget = 0;
        $lastDiff = 1000000000;
        foreach ($futureBudgets as $key => $futureBudget) {
            $datetime1 = date_create($currentYear . '-' . $currentMonth . '-01');
            $datetime2 = date_create($futureBudget->year . '-' . $futureBudget->month . '-01');

            $interval = date_diff($datetime1, $datetime2);
            $diffMonths = $interval->y * 12 + $interval->m;
            if ($diffMonths < $lastDiff) {
                $closestBudget = $futureBudget->id;
                $lastDiff = $diffMonths;
            }
        }

        return $closestBudget;
    }


    public function saveDescription() {
        $budget = PlanBudget::where('id', request()->currentBudget)->first();

        $budget->description = request()->description;
        $budget->save();

        return view('reports.budgets', [
            'budgetId' => request()->currentBudget,
        ]);
    }
=======

    public function showCurrentExpenses(Request $request)
    {
        //dump($request);
        if(is_null($request->date)) {
            $da = now();
            $year = date('Y', strtotime($da));
            $month = date('m', strtotime($da));
        }
        else {
            $da = $request->date;
            $dateComps = date_parse($da);
            $year = $dateComps['year'];
            $month = $dateComps['month'];
        }

        if($request->action == 'next') {
            if ($month == 12) {
                $month = 1;
                $year++;
            } else {
                $month++;
            }
        }
        if($request->action == 'previous') {
            if ($month == 1) {
                $month = 12;
                $year--;
            } else {
                $month--;
            }
        }
        $currentExpenses = expenses::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $expCategories = ExpensesType::all();
        foreach ($expCategories as $expCategory)
        {
            $expCat[$expCategory->id] = $expCategory->name;
        }

        $users = User::all();
        foreach ($users as $user)
        {
            $username[] = $user->last_name . ' ' . $user->first_name;
        }

        return view('current_expenses', [
            'currentExpenses' => $currentExpenses,
            'expCat' => $expCat,
            'username' => $username,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function showCurrentIncomes(Request $request)
    {
        //dump($request);
        if(is_null($request->date)) {
            $da = now();
            $year = date('Y', strtotime($da));
            $month = date('m', strtotime($da));
        }
        else {
            $da = $request->date;
            $dateComps = date_parse($da);
            $year = $dateComps['year'];
            $month = $dateComps['month'];
        }

        if($request->action == 'next') {
            if ($month == 12) {
                $month = 1;
                $year++;
            } else {
                $month++;
            }
        }
        if($request->action == 'previous') {
            if ($month == 1) {
                $month = 12;
                $year--;
            } else {
                $month--;
            }
        }

        $array = [];

        $incCategories = IncomesType::all();
        foreach ($incCategories as $incCategory)
        {
            $incCat[$incCategory->id] = $incCategory->name;
        }

        $currentIncomes = Incomes::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $i=0;

        foreach ($currentIncomes as $currentIncome)
        {
            $i++;
            $array [] = [
                'id' => $currentIncome['id'],
                'num' => $i,
                'name' => $incCat[$currentIncome['incomes_types_id']],
                'sum' => $currentIncome['sum'],
            ];
        }

        return view('current_incomes', [
            'currentIncomes' => $array,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function showCurrentBudget(Request $request)
    {
        //dump($request);

        if(is_null($request->date)) {
            $da = now();
            $year = date('Y', strtotime($da));
            $month = date('m', strtotime($da));
        }
        else {
            $da = $request->date;
            $dateComps = date_parse($da);
            $year = $dateComps['year'];
            $month = $dateComps['month'];
        }

        if($request->action == 'next') {
            if ($month == 12) {
                $month = 1;
                $year++;
            } else {
                $month++;
            }
        }
        if($request->action == 'previous') {
            if ($month == 1) {
                $month = 12;
                $year--;
            } else {
                $month--;
            }
        }

        $array2 = [];

        $incCategories = IncomesType::all();
        foreach ($incCategories as $incCategory)
        {
            $incCat[] = $incCategory->name;
        }

        $currentIncomes = Incomes::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $i=0;
        $sumPercent = 0;
        foreach ($currentIncomes as $currentIncome)
        {
            $i++;
            $array2 [] = [
                'id' => $currentIncome['id'],
                'num' => $i,
                'name' => $incCat[$currentIncome['incomes_types_id']-1],
                'sum' => $currentIncome['sum'],
            ];
            if (IncomesType::find($currentIncome['incomes_types_id'])->is_percent) {
                $sumPercent += $currentIncome['sum'];
            }
        }

        $array = [];

        $budgetItems = PlanBudget::where('month', '=', $month)
            ->where('year', '=', $year)
            ->orderBy('ordernum_id')
            ->get();

        foreach ($budgetItems as $budgetItem)
        {

            if(expenses::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('expensestypes_id', '=', $budgetItem->expensestypes_id)->count() == 0) {
                $sumWasted = 0;
            } else {
                $sumWasted = expenses::select('expensestypes_id', expenses::raw('SUM(sum) as sum'))
                    ->where('expensestypes_id', '=', $budgetItem->expensestypes_id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->groupBy('expensestypes_id')
                    ->first()->sum;
            }

            if (ExpensesType::find($budgetItem->expensestypes_id)->is_percent) {
                $array[] = [
                    'expType' => ExpensesType::find($budgetItem->expensestypes_id)->name,
                    'sumPlan' => $sumPercent/100*ExpensesType::find($budgetItem->expensestypes_id)->percent,
                    'sumWasted' => $sumPercent/100*ExpensesType::find($budgetItem->expensestypes_id)->percent,
                    'sumRemain' => 0,
                ];
            } else {
                $array[] = [
                    'expType' => ExpensesType::find($budgetItem->expensestypes_id)->name,
                    'sumPlan' => $budgetItem->sum,
                    'sumWasted' => $sumWasted,
                    'sumRemain' => $budgetItem->sum - $sumWasted,
                ];
            }
        }
//dd($array);
        $notes = (BudgetNote::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->first());
        if(!$notes) {
            $note = "";
        } else {
            $note = $notes['note'];
        }

         return view('current_budget', [
            'currentExpenses' => $array,
            'currentIncomes' => $array2,
            'month' => $month,
            'year' => $year,
            'note' => $note,
        ]);
    }

    public function otherBudget()
    {
        return view('otherbudgetform');
    }

>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
}
