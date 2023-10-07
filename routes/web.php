<?php

use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PlanBudgetController;
use App\Http\Controllers\GodController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\TelegramController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Setting;
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\PlanBudgetController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExpensesTypeController;
use App\Http\Controllers\IncomesTypeController;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
<<<<<<< HEAD
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
=======
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
|
*/

Route::get('/', function () {
    return view('mainpage');
<<<<<<< HEAD
})->middleware(['auth', 'verified'])->name('mainpage');

Route::get('/tbot', [TelegramController::class, 'getMe']);
Route::get('/tbot/setwebhook', [TelegramController::class, 'setWebHook']);
Route::post('/webhook', [TelegramController::class, 'getFromBot']);


=======
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
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/transaction', [CashFlowController::class, 'index'])->name('transaction');
    Route::post('/transaction/new', [CashFlowController::class, 'create'])->name('transaction.new');
    Route::post('/transaction/delete', [CashFlowController::class, 'delete'])->name('transaction.delete');


    Route::get('/refbooks', function () {
        return view('refbooks');
    })->name('refbooks');
    Route::get('/refbooks/accounts', [AccountController::class, 'show'])->name('account.show');
    Route::post('/refbooks/accounts/update', [AccountController::class, 'update'])->name('account.update');
    Route::post('/refbooks/accounts/delete', [AccountController::class, 'delete'])->name('account.delete');
    Route::post('/refbooks/accounts/create', [AccountController::class, 'create'])->name('account.create');

    Route::get('/reports', function () {
        return view('reports.reports-list');
    })->name('reports.list');
    Route::get('/reports/transactions', [ReportsController::class, 'showTransactions'])->name('reports.transactions');
    Route::post('/reports/transactions', [ReportsController::class, 'showTransactions'])->name('post.reports.transactions');
    Route::get('/reports/budgets', [ReportsController::class, 'showBudgets'])->name('reports.budgets');
    Route::post('/reports/budgets', [ReportsController::class, 'showBudgets'])->name('post.reports.budgets');

    Route::get('/budget-planning', [PlanBudgetController::class, 'index']);
    Route::post('/budget-planning', [PlanBudgetController::class, 'index']);
    Route::post('/budget-planning/add', [PlanBudgetController::class, 'add'])->name('planbudget.add');
    Route::post('/budget-planning/edit', [PlanBudgetController::class, 'index'])->name('planbudget.edit');
    Route::get('/budget-planning/edit', [PlanBudgetController::class, 'index']);

    Route::post('/budget-planning/add-item', [PlanBudgetController::class, 'addItem'])->name('planbudget.addItem');
    Route::get('/budget-planning/add-item', [PlanBudgetController::class, 'addItem']);
    Route::post('/budget-planning/delete-item', [PlanBudgetController::class, 'deleteItem'])->name('planbudget.deleteItem');
    Route::get('/budget-planning/delete-item', [PlanBudgetController::class, 'deleteItem']);

    Route::post('/budget-planning/clone-budget', [PlanBudgetController::class, 'clone'])->name('planbudget.clone');

    Route::post('/budget-planning/add-income', [PlanBudgetController::class, 'addIncome'])->name('planbudget.addIncome');
    Route::get('/budget-planning/add-income', [PlanBudgetController::class, 'addIncome']);
    Route::post('/budget-planning/delete-income', [PlanBudgetController::class, 'deleteIncome'])->name('planbudget.deleteIncome');
    Route::get('/budget-planning/delete-income', [PlanBudgetController::class, 'deleteIncome']);

    Route::post('/reports/save-description', [ReportsController::class, 'saveDescription'])
        ->name('addDescription');

    Route::get('/god', function () {
       return view('god-mainpage');
    });
    Route::get('/god/users', [GodController::class, 'showUsers']);
    Route::post('/god/users/change-ban', [GodController::class, 'changeBanStatus'])->name('changeUserBan');
    Route::post('/god/users/user-delete', [GodController::class, 'deleteUser'])->name('user.delete');

    Route::get('/settings', function () {
        $settings = Setting::where('user_id', Auth::user()->id)->first();
        return view('settings', ['settings' => $settings]);
    })->name('settings');
    Route::post('/settings/save' , [SettingController::class, 'save'])->name('settings.save');

});

require __DIR__.'/auth.php';
=======
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
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
