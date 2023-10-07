<html>
<head>
    <title>Отчеты. Выбор месяца</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<x-return-to-reports/>
<div class="container d-flex flex-row justify-content-center">
    <h2>Бюджеты произвольных месяцев</h2>
</div>

<div class="p-2 d-grid py-2 justify-content-center">
    <form name="budget" id="budget" method="post" enctype="multipart/form-data" action="{{url('/reports/showotherbudgets')}}">
        @csrf
        <div class="p-2">
            @php
                $time=strtotime(now());
                $month=date("m",$time);
                $year=date("Y",$time);
            @endphp
            <label for="date">Задайте месяц и год бюджета</label>
            <input type="month" id="start" name="date"
                   value="{{$year}}-{{$month}}" required>
        </div>
        <div class="d-grid col-3 mx-auto py-2">
            <button type="submit" class="btn btn-primary shadow-lg" name="action" value="date">Показать</button>
            <br>
        </div>
    </form>
</div>
</body>
</html>
