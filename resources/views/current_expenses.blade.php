<head>
    <title>Отчет. Текущие расходы</title>
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

<x-paginate-expinc :$month :$year />

<div class="container d-flex flex-row justify-content-center">
    <h2>Расходы</h2>
</div>
<div class="container d-flex flex-row justify-content-center">
    <table class="border shadow-lg" style="border: 1px solid white;">
        <tr>
            <th style="border: 1px solid;  text-align: center; padding: 3px;">#</th>
            <th style="border: 1px solid; text-align: center;">Дата</th>
            <th style="border: 1px solid; text-align: center;">Размер</th>
            <th style="border: 1px solid; text-align: center;">Статья расхода</th>
            <th style="border: 1px solid; text-align: center;">Автор записи</th>
            <th style="border: 1px solid; text-align: center;">Комментарий</th>
            <th style="border: 1px solid; text-align: center;">Действие</th>
        </tr>
    @php
        $count=0;
    @endphp

    @foreach($currentExpenses as $currentExpense)
    @php
        $count++;
    @endphp
            <tr>
                <td style="border: 1px solid; text-align: center;">{{$count}}</td>
                <td style="border: 1px solid;">{{$currentExpense['created_at']}}</td>
                <td style="border: 1px solid; text-align: center;">{{$currentExpense['sum']}} р.</td>
                <td style="border: 1px solid; text-align: center;">{{$expCat[$currentExpense['expensestypes_id']]}}</td>
                <td style="border: 1px solid; text-align: center;">{{$username[$currentExpense['user_id']-1]}}</td>
                <td style="border: 1px solid;">{{$currentExpense['comment']}}</td>
                <td style="border: 1px solid;">
                    <form name="delete" id="expense" method="post" enctype="multipart/form-data" action="{{url('/delete/expense')}}">
                        @csrf
                        <button type="submit" class="" name="action" value="{{$currentExpense['id']}}">Удалить</button>
                    </form>
                </td>
            </tr>
    @endforeach
    </table>
</div>
<x-return-to-top/>

