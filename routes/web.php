<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\PlanBudgetController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExpensesTypeController;
use App\Http\Controllers\IncomesTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mainpage');
});
Route::get('/mainpage', function () {
    return view('mainpage');
})->name('mainpage');

Route::post('/add/expense', function () {
    return view('addexpense');
})->name('addexpense');
Route::post('/add/expensesave', [ExpensesController::class, 'addNewExpense']);
Route::post('/delete/expense', [ExpensesController::class, 'deleteExpense']);

Route::post('/add/income', function () {
    return view('addincome');
})->name('addincome');
Route::post('/add/incomesave', [IncomesController::class, 'addNewIncome']);
Route::post('/delete/income', [IncomesController::class, 'deleteIncome']);

Route::post('/planning', function () {
    return view('planningform');
})->name('planning');
Route::post('/planning/edit', [PlanBudgetController::class, 'budgetEdit']);
Route::post('/planning/save/{year}/{month}', [PlanBudgetController::class, 'budgetSave'])->name('planningsave');
Route::post('/planning/create/{year}/{month}', [PlanBudgetController::class, 'budgetCreate'])->name('planningcreate');
Route::post('/planning/delete', [PlanBudgetController::class, 'budgetDelete'])->name('planningdelete');

Route::post('/add/expensetype', function () {
    return view('addexpensetype');
})->name('addexpensetype');
Route::post('/add/newexpensetype', [ExpensesTypeController::class, 'addNewExpenseType']);

Route::post('/add/incometype', function () {
    return view('addincometype');
})->name('addincometype');
Route::post('/add/newincometype', [IncomesTypeController::class, 'addNewIncomeType']);

Route::post('/reportslist', function () {
    return view('reportslist');
})->name('reportslist');
Route::get('/reports/currentexpenses', [ReportsController::class, 'showCurrentExpenses']);
Route::post('/reports/currentexpenses', [ReportsController::class, 'showCurrentExpenses']);
Route::get('/reports/currentincomes', [ReportsController::class, 'showCurrentIncomes']);
Route::post('/reports/currentincomes', [ReportsController::class, 'showCurrentIncomes']);
Route::get('/reports/currentbudget', [ReportsController::class, 'showCurrentBudget']);
Route::get('/pdf/currentbudget', [PdfController::class, 'showCurrentBudget']);
Route::get('/reports/otherbudget', function () {
    return view('otherbudgetform');
});
Route::post('/reports/showotherbudgets', [ReportsController::class, 'showCurrentBudget']);

Route::post('/note/update/{month}/{year}', [PlanBudgetController::class, 'noteUpdate']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// изменил в budget3
// и еще чуть

// для очистки БД и сброса индексов

/*Route::get('/truncate', function () {
  DB::table('incomes')->truncate();
  DB::table('expenses')->truncate();
  DB::table('expensestypes')->truncate();
  DB::table('incomes_types')->truncate();
  DB::table('plan_budgets')->truncate();
  DB::table('users')->truncate();
  DB::table('budget_notes')->truncate();
  die();
  });*/
