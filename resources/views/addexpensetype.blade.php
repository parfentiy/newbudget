<html>
<head>
    <title>Добавление новой статьи расхода</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<x-return-to-main/>
<div class="container text-center">
    <h2>Добавление статьи расходов</h2>
</div>
<form class="container" name="delete" id="expense" method="post" enctype="multipart/form-data" action="{{url('/add/newexpensetype')}}">
    @csrf
    <div class="p-5">
        <div class="mb-3">
            <label for="name">Наименование новой статьи расхода: </label>
            <input class="form-control shadow" type="text" name="name" value="" required>
        </div>
        <div class="mb-3">
            <label class="form-check-label" for="ispercent">Зависит от дохода?: </label>
            <input class="form-check-input shadow" type="checkbox" name="ispercent">
        </div>
        <div class="mb-3">
            <label for="percent">Размер %: </label>
            <input class="form-control shadow" type="text" name="percent" value="" required>
        </div>
        <div class="mb-3">
            <label for="ordernum">Порядковый номер: </label>
            <input class="form-control shadow" type="text" name="ordernum" value="" required>
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary shadow-lg" name="expensetype" value="expense">Добавить</button>
            <br>
        </div>
    </div>
</form>
</body>
</html>
