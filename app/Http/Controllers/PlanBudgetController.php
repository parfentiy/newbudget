<?php

namespace App\Http\Controllers;

use App\Models\PlanBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanBudgetController extends Controller
{
    //
    public function index() {
        //dd(request());
        if (isset(request()->delete)) {
            $this->delete(request()->delete);
        }
        $planBudgets = PlanBudget::where('user_id', Auth::user()->id)->get();

        if (is_null(request()->isSet)) {
            $currentBudget = [];
            $isCurrentBudgetSet = false;
            $budgetItems = [];

            //dump($currentBudget);
        } else {
            $currentBudget = PlanBudget::whereId(request()->budgetId)->first();

            $budgetItems = json_decode(PlanBudget::whereId(request()->budgetId)->pluck('dataset')->first(), true);
            //dd($currentBudget);
            usort($budgetItems, function ($a, $b) {
                return $a['order'] <=> $b['order'];
            });
            //dd($budgetItems);
            $isCurrentBudgetSet = true;
        }
        return view('planbudget', [
            'planBudgets' => $planBudgets,
            'currentBudget' => $currentBudget,
            'currentBudgetItems' => $budgetItems,
            'isCurrentBudgetSet' => $isCurrentBudgetSet,
        ]);
        //dd(request());
    }

    public function add() {
        //dd(request());

        PlanBudget::create([
            'month' => request()->month,
            'year' => request()->year,
            'user_id' => Auth::user()->id,
            'dataset' => json_encode([]),

        ]);

        $planBudgets = PlanBudget::where('user_id', Auth::user()->id)->get();
        $currentBudget = [];
        $isCurrentBudgetSet = false;
        $budgetItems = [];

        return view('planbudget', [
            'planBudgets' => $planBudgets,
            'currentBudget' => $currentBudget,
            'currentBudgetItems' => $budgetItems,
            'isCurrentBudgetSet' => $isCurrentBudgetSet,
        ]);
    }

    public function delete($id) {
        //dd($id);
        PlanBudget::whereId($id)->delete();

        $planBudgets = PlanBudget::where('user_id', Auth::user()->id)->get();
        $currentBudget = [];
        $isCurrentBudgetSet = false;
        $budgetItems = [];

        return view('planbudget', [
            'planBudgets' => $planBudgets,
            'currentBudget' => $currentBudget,
            'currentBudgetItems' => $budgetItems,
            'isCurrentBudgetSet' => $isCurrentBudgetSet,
        ]);
    }

    public function addItem() {
        //dd(request());
        $budget = PlanBudget::where('id', request()->currentBudget)->first();
        //dd($budget->dataset);
        $array = [];
        foreach (json_decode($budget->dataset, true) as $item) {
            $array[] = $item;
        }
        $array[] = [
            'account' => (int) request()->account_id,
            'sum' => (int) request()->sum,
            'order' => (int) request()->order,
        ];

        $budget->dataset = $array;
        $budget->save();

        $planBudgets = PlanBudget::where('user_id', Auth::user()->id)->get();
        $currentBudget = PlanBudget::where('id', request()->currentBudget)->first();
        $budgetItems = json_decode(PlanBudget::whereId(request()->currentBudget)->pluck('dataset')->first(), true);
        usort($budgetItems, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        $isCurrentBudgetSet = true;

        return view('planbudget', [
            'planBudgets' => $planBudgets,
            'currentBudget' => $currentBudget,
            'currentBudgetItems' => $budgetItems,
            'isCurrentBudgetSet' => $isCurrentBudgetSet,
        ]);
    }

    public function deleteItem() {
        //dd(request());
        $currentBudget = PlanBudget::where('id', request()->currentBudget)->first();

        //dd($currentBudget->dataset);
        $array = [];
        foreach (json_decode($currentBudget->dataset, true) as $item) {
            //dump($item['order']);
            if ($item['order'] != request()->id) {
                $array[] = $item;
            }
        }

        $currentBudget->dataset = $array;
        $currentBudget->save();
        //dd($array);

        $planBudgets = PlanBudget::where('user_id', Auth::user()->id)->get();
        $currentBudget = PlanBudget::where('id', request()->currentBudget)->first();
        $budgetItems = json_decode(PlanBudget::whereId(request()->currentBudget)->pluck('dataset')->first(), true);
        usort($budgetItems, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        $isCurrentBudgetSet = true;

        return view('planbudget', [
            'planBudgets' => $planBudgets,
            'currentBudget' => $currentBudget,
            'currentBudgetItems' => $budgetItems,
            'isCurrentBudgetSet' => $isCurrentBudgetSet,
        ]);
    }
}
