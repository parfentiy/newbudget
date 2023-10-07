<head>
    <title>Отчет. Текущие доходы</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<a name="top"></a>
<x-header/>
<div class="d-flex flex-row justify-content-around">
    <div>
        <x-return-to-reports/>
    </div>
    <div>
        <x-return-to-main/>
    </div>
    <div>
        <form name="delete" id="expense" method="post" enctype="multipart/form-data" action="">
            @csrf
            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger shadow-lg disabled" name="expense" value="expense">Скачать в PDF</button>
                <br>
            </div>
        </form>
    </div>
</div>

<x-paginate-incomes :$month :$year />

<div class="container d-flex flex-row justify-content-center">
    <h2>Доходы</h2>
</div>

<div  class="container d-flex flex-row justify-content-center">
    <table class="border shadow-lg" style="border: 1px solid white; border-collapse: collapse">
        <tr>
            <th style="border: 1px solid; text-align: center; padding: 3px;">#</th>
            <th style="border: 1px solid; text-align: center;">Статья дохода</th>
            <th style="border: 1px solid; text-align: center;">Размер</th>
            <th style="border: 1px solid; text-align: center;">Действие</th>
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
                <td style="border: 1px solid;">
                    <form name="delete" id="expense" method="post" enctype="multipart/form-data" action="{{url('/delete/income')}}">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="" name="income" value="{{$currentIncome['id']}}">Удалить</button>
                            <br>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid;"></td>
            <td style="border: 1px solid;"><b>ИТОГО:</b></td>
            <td style="border: 1px solid; text-align: center;"><b>{{$sum}} р.</b></td>
    </table>
</div>
<x-return-to-top/>

