<?php

namespace App\Http\Controllers;

use App\Models\BudgetNote;
use App\Models\expenses;
use App\Models\ExpensesType;
use App\Models\Incomes;
use App\Models\IncomesType;
use App\Models\PlanBudget;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    //
    static public function pdfmaker($request) {
        //dd($request);
        /*switch ($request->reportType) {
            case 'currentbudget' :
                $pdf = Pdf::loadView('current_budget', [
                    'currentExpenses' => unserialize($request->curExp),
                    'currentIncomes' => unserialize($request->curInc),
                    'month' => $request->month,
                    'year' => $request->year,
                    'note' => $request->note,
                ]);

                //dump($pdf->download('invoice.pdf'));



        }*/
        echo 'eeee';
        return route('currentbudget');
        //$pdf->download('invoice.pdf');
    }

    public function showCurrentBudget(Request $request)
    {
        //dd($request);
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

        $notes = (BudgetNote::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->first());
        if(!$notes) {
            $note = "";
        } else {
            $note = $notes['note'];
        }

        $pdf = Pdf::loadView('current_budget_pdf', [
            'currentExpenses' => $array,
            'currentIncomes' => $array2,
            'month' => $month,
            'year' => $year,
            'note' => $note,
        ]);
        $pdf->setOption('defaultFont', 'DejaVu Sans');
        $pdf->setOption('fontHeightRatio', '0.7');
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->download('Бюджет_' . $month . '-' . $year . ' ' . now() . '.pdf');

    }
}
