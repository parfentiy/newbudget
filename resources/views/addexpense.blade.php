@php
    $expensesTypes = App\Models\ExpensesType::all();
@endphp
<html>
<head>
    <title>Добавление нового расхода</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<x-return-to-main/>
<div>
    Последний расход: Сумма - {{\App\Models\expenses::latest('updated_at')->first()->sum}} рублей
    , статья: {{\App\Models\ExpensesType::whereId(\App\Models\expenses::latest('updated_at')->first()->expensestypes_id)->first()->name}}
</div>
<form class="container" style="" name="newexpense" id="newexpense" method="post" enctype="multipart/form-data" action="{{url('/add/expensesave')}}">
    @csrf
    <div class="text-center bd-highlight">
        <h2>Добавить расход</h2>
    </div>
    <div class="p-2">
        <div class="mb-3">
            <label for="sum">Сумма расхода</label>
            <input type="text" id="sum" name="sum" class="form-control shadow py-2" required>
        </div>
        <div class="mb-3">
            <label for="expType">Статья расхода</label>
            <select class="form-select form-select-lg shadow py-2" name="expType" id="expType">
                @foreach($expensesTypes as $expensesType)
                    <option value="{{$expensesType['id']}}">{{$expensesType['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="comment">Комментарий</label>
            <input type="text" id="comment" name="comment" class="form-control shadow py-2">
        </div>
        <div class="form-group">
            <label for="date">Дата расхода</label>
            <input class="form-control shadow py-2" type="date" id="start" name="date"
                   value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary shadow-lg" name="action" value="expense">Добавить</button>
            <br>
        </div>
    </div>
</form>
</body>
</html>
