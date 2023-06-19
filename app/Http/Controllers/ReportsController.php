<?php

namespace App\Http\Controllers;

use App\Models\PlanBudget;
use Illuminate\Http\Request;
use App\Models\expenses;
use App\Models\ExpensesType;
use App\Models\User;
use App\Models\Incomes;
use App\Models\IncomesType;
use App\Models\BudgetNote;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    //

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

}
