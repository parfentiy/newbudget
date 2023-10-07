@php
    $incomeTypes = App\Models\IncomesType::all();
@endphp
<html>
<head>
    <title>Добавление нового дохода</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<x-header/>
<x-return-to-main/>
<body>
<div class="container text-center">
    <h2>Добавить доход</h2>
</div>
<form class="container" name="newincome" id="newincome" method="post" enctype="multipart/form-data" action="{{url('/add/incomesave')}}">
    @csrf
    <div class="p-5">
        <div class="mb-3">
            <label for="sum">Сумма дохода: </label>
            <input type="text" id="sum" name="sum" class="form-control shadow" required>
        </div>
        <div class="mb-3">
            <label for="incType">Статья дохода: </label>
            <select class="form-select shadow" name="incType" id="incType">
                @foreach($incomeTypes as $incomeType)
                    <option value="{{$incomeType['id']}}">{{$incomeType['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date">Дата дохода: </label>
            <input class="form-control shadow" type="date" id="start" name="date"
                   value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary shadow-lg" name="action" value="income">Добавить</button>
            <br>
        </div>
    </div>
</form>
</body>
</html>
