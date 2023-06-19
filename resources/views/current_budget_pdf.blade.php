@php
    $arr = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
@endphp

<style type="text/css">
    * {
        /*font-family: Helvetica, sans-serif;*/
        font-family: "DejaVu Sans", sans-serif;
        font-size: 15px;

    }
</style>
<head>
    <title>Отчет. Текущий бюджет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<x-header/>

<table style="margin: auto;"><tbody>
    <div class="d-flex flex-row justify-content-around">
        <b>{{$arr[$month-1]}} - {{$year}}</b>
    </div>
    <td style="vertical-align: top; align="center";">
    <div><h2>Текущие расходы</h2>
    <table  style="border: 1px solid white; border-collapse: collapse">
        <tr>
            <th style="border: 1px solid; padding: 3px;">#</th>
            <th style="border: 1px solid;">Статья</th>
            <th style="border: 1px solid;">Надо</th>
            <th style="border: 1px solid;">Потрачено</th>
            <th style="border: 1px solid;">Осталось</th>
        </tr>
        @php
            $count=0;
            $totalExpensesPlan = 0;
            $totalExpensesWasted = 0;
            $totalExpensesRemain = 0;
        @endphp

        @foreach($currentExpenses as $currentExpense)
            @php
                $count++;
                $totalExpensesPlan += $currentExpense['sumPlan'];
                $totalExpensesWasted += $currentExpense['sumWasted'];
                $totalExpensesRemain += $currentExpense['sumRemain'];
            @endphp
            <tr>
                <td style="border: 1px solid; text-align: center;">{{$count}}</td>
                <td style="border: 1px solid; text-align: left;">{{$currentExpense['expType']}}</td>
                <td style="border: 1px solid; text-align: right;">{{$currentExpense['sumPlan']}} р.</td>
                <td style="border: 1px solid; text-align: right;">{{$currentExpense['sumWasted']}} р.</td>
                @if($currentExpense['sumRemain'] < 0)
                    <td style="border: 1px solid; color: red; text-align: right;">
                        {{$currentExpense['sumRemain']}} р.
                    </td>
                @elseif($currentExpense['sumRemain'] != 0)
                    <td style="border: 1px solid; text-align: right;">
                        {{$currentExpense['sumRemain']}} р.
                    </td>
                @else
                    <td style="border: 1px solid; text-align: right;"></td>
                @endif

            </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid; text-align: center;"></td>
            <td style="border: 1px solid; text-align: left;"><b>ИТОГО:</b></td>
            <td style="border: 1px solid; text-align: right;"><b>{{$totalExpensesPlan}} р.</b></td>
            <td style="border: 1px solid; text-align: right;"><b>{{$totalExpensesWasted}} р.</b></td>
            <td style="border: 1px solid; text-align: right;"><b>{{$totalExpensesRemain}} р.</b></td>
        </tr>
    </table>
    </div>
    </td>
    <td style="vertical-align: top; align="center";">
    <div>
        <div style="padding-right: 40px">
        <h2>Текущие доходы</h2>
        <table  style="border: 1px solid white; border-collapse: collapse">
            <tr>
                <th style="border: 1px solid; padding: 3px;">#</th>
                <th style="border: 1px solid;">Статья дохода</th>
                <th style="border: 1px solid;">Размер</th>
            </tr>
            @php
                $sum = 0;
            @endphp
            @foreach($currentIncomes as $currentIncome)
                @php
                    $sum += $currentIncome['sum'];
                @endphp
                <tr>
                    <td style="border: 1px solid;">{{$currentIncome['num']}}</td>
                    <td style="border: 1px solid;">{{$currentIncome['name']}}</td>
                    <td style="border: 1px solid; text-align: center;">{{$currentIncome['sum']}} р.</td>
                </tr>
            @endforeach
            <tr>
                <td style="border: 1px solid;"></td>
                <td style="border: 1px solid;"><b>ИТОГО:</b></td>
                <td style="border: 1px solid; text-align: center;"><b>{{$sum}} р.</b></td>
        </table>
        </div>

        <div>
            <h2>Баланс</h2>
            <table  style="border: 1px solid white; border-collapse: collapse">
                <tr>
                    <td style="border: 1px solid;">Общий доход</td>
                    <td style="border: 1px solid; text-align: center;">{{$sum}} р.</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;">Расход</td>
                    <td style="border: 1px solid; text-align: center;">{{$totalExpensesPlan}} р.</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;">Остаток по плану</td>
                    <td style="border: 1px solid; text-align: center;">{{$sum - $totalExpensesPlan}} р.</td>
                </tr>
            </table>
        </div>
    </div>
    </td>

    <td style="vertical-align: top; align="center";>
        <div>
            <form name="notes" method="post" enctype="multipart/form-data" action="{{url("/note/update/$month/$year")}}">
                @csrf
                <label for="note"><h2>Заметки</h2></label>
                <textarea style="width: 200px; height: 450px;" id="note" name="note" class="form-control shadow">
                   {{$note}}
                </textarea>
                <div class="form-group mt-3 text-center">
                    <button type="submit" class="btn btn-primary shadow-lg" name="action" value="note">Сохранить</button>
                    <br>
                </div>
            </form>
        </div>
    </td>
</tbody></table>

