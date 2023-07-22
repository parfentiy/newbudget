@php
    $months = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
@endphp

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
    <style>
        form {
            margin: 1; /* Убираем отступы */
        }
    </style>
</head>

<x-header/>
@include('layouts.reports')

@php
    if(isset($budgetId)) {
        $currentBudget = \App\Models\PlanBudget::whereId($budgetId)->first();
        $currentBudgetItems = json_decode(\App\Models\PlanBudget::whereId($budgetId)->pluck('dataset')->first(), true);
        $currentIncomeAccounts = [];
        foreach (json_decode(\App\Models\PlanBudget::whereId($budgetId)->pluck('incomes')->first(), true) as $item) {
            $currentIncomeAccounts[] = $item['account'];
        }
        $currentBudgetIncomes = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                                        ->whereIn('source_account_id', $currentIncomeAccounts)
                                        ->whereMonth('operation_date', $currentBudget['month'])
                                        ->whereYear('operation_date', $currentBudget['year'])
                                        ->get();

        usort($currentBudgetItems, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }
    //dd($currentBudgetIncomes);
@endphp

<div>
    <div class="d-flex flex-row justify-content-center">
        <h2>Бюджет</h2>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>

            </div>
            <h4>Список бюджетов</h4>
            <div class="d-flex flex-row justify-content-center">
                <table class="table table-bordered table-striped table-hover table-sm caption-top align-top">
                    <thead class="table-light text-center align-top">
                    <tr>
                    </tr>
                    </thead>
                    <tbody class="text-center">

                    @foreach (\App\Models\PlanBudget::where('user_id', Auth::user()->id)->orderBy('year')->orderBy('month')->get() as $key => $planBudget)
                        <tr>
                            <input type="hidden" name="budgetId" value="{{$planBudget->id}}">
                            <td>
                                <a href="{{url('/reports/budgets?budgetId=' . $planBudget->id)}}" class="btn btn-primary shadow-lg">
                                    {{$months[$planBudget->month - 1]}} {{$planBudget->year}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div class="d-flex flex-row text-center fw-bold">
                @if (!isset($budgetId))
                    Текущий бюджет не выбран
                @else
                    Текущий бюджет -> {{$months[$currentBudget['month'] - 1]}} - {{$currentBudget['year']}}
                @endif
            </div>
            <div>
                @if (isset($budgetId))
                    <table class="table table-sm table-bordered table-striped table-hover align-top">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Статья</th>
                            <th scope="col">Надо</th>
                            <th scope="col">Потрачено</th>
                            <th scope="col">Осталось</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalPlan = 0;
                            $totalWasted = 0;
                        @endphp
                        @foreach($currentBudgetItems as $item)
                            @php
                                $wasted = \App\Models\CashFlow::where('user_id', Auth::user()->id)
                                        ->where('dest_account_id', $item['account'])
                                        ->whereMonth('operation_date', $currentBudget['month'])
                                        ->whereYear('operation_date', $currentBudget['year'])
                                        ->pluck('amount')
                                        ->sum();
                            @endphp
                            <tr>
                                <input type="hidden" name="id" value="{{$item['order']}}">
                                <td class="text-center">
                                    {{$item['order']}}
                                </td>
                                <td>
                                    {{\App\Models\Account::find($item['account'])->name}}
                                </td>
                                <td class="text-right">
                                    {{$item['sum']}} р.
                                </td>
                                <td class="text-right">
                                    {{$wasted}} р.
                                </td>
                                @if ($item['sum'] - $wasted < 0)
                                    <td class="text-right text-danger fw-bold">
                                        {{$item['sum'] - $wasted}} р.
                                    </td>
                                @elseif ($item['sum'] - $wasted == 0)
                                    <td class="text-right text-danger fw-bold">
                                    </td>
                                @else
                                    <td class="text-right">
                                        {{$item['sum'] - $wasted}} р.
                                    </td>
                                @endif
                            </tr>
                            @php
                                $totalPlan += $item['sum'];
                                $totalWasted += $wasted;
                            @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td>

                                </td>
                                <td class="text-left fw-bold">
                                    ИТОГО:
                                </td>
                                <td class="text-right fw-bold">
                                    {{$totalPlan}} р.
                                </td>
                                <td class="text-right fw-bold">
                                    {{$totalWasted}} р.
                                </td>
                                <td class="text-right fw-bold">
                                    {{$totalPlan - $totalWasted}} р.
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                @endif
            </div>
        </div>
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div class="d-flex flex-row text-center fw-bold">
                @if (isset($budgetId))
                    Текущие доходы
                @endif
            </div>
            <div>
                @if (isset($budgetId))
                    <table class="table table-sm table-bordered table-striped table-hover align-top">
                        <thead>
                        <tr>
                            <th scope="col">Статья</th>
                            <th scope="col">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($currentBudgetIncomes as $item)
                            <tr>
                                <td>
                                    {{\App\Models\Account::find($item['source_account_id'])->name}}
                                </td>
                                <td class="text-right">
                                    {{$item['amount']}} р.
                                </td>
                            </tr>
                            @php
                                $total += $item['amount'];
                            @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="fw-bold">
                            <td class="fw-bold">
                                ИТОГО:
                            </td>
                            <td class="fw-bold">
                                {{$total}} р.
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                @endif
            </div>
            <div>
                <h4>Баланс</h4>
                <table class="table table-sm table-bordered table-striped table-hover align-top">
                    <tr>
                        <td>Общий доход</td>
                        <td class="text-right">{{$total}} р.</td>
                    </tr>
                    <tr>
                        <td>Расход</td>
                        <td class="text-right">{{$totalPlan}} р.</td>
                    </tr>
                    <tr>
                        <td>Остаток по плану</td>
                        <td class="text-right">{{$total - $totalWasted}} р.</td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            @if (isset($budgetId))
                <div>
                    <h4>Заметки бюджета</h4>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    <div class="form-control" id="exampleFormControlTextarea1" rows="10" style="height: 450; width: 350">
                        {{$currentBudget->description}}
                    </div>
                </div>
                </div>
            @endif
        </div>
    </div>
</div>
