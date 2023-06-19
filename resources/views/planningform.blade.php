<head>
    <title>Планирование бюджета</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<html>
<body>

<x-header/>
<x-return-to-main/>
<div class="container text-center">
    <h2>Планирование бюджета</h2>
</div>
<div>
    <form class="container" name="budget" id="budget" method="post" enctype="multipart/form-data" action="{{url('/planning/edit')}}">
        @csrf
        <div class="form-group mb-3">
            @php
                $time=strtotime(now());
                $month=date("m",$time);
                $year=date("Y",$time);
            @endphp
            <label for="date">Задайте месяц и год планируемого бюджета</label>
            <input class="form-control shadow py-2" type="month" id="start" name="date"
                   value="{{$year}}-{{$month}}" required>
        </div>
        <div class="form-group text-center mb-3">
            <button type="submit" class="btn btn-primary shadow-lg" name="action" value="date">Планировать</button>
            <br>
        </div>
    </form>
</div>
</body>
</html>

