<html>
<head>
    <title>Добавление новой статьи дохода</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<x-return-to-main/>
<div class="container text-center">
    <h2>Добавление новой статьи дохода</h2>
</div>
<form class="container" name="income" id="income" method="post" enctype="multipart/form-data" action="{{url('/add/newincometype')}}">,
    @csrf
    <div class="p-5">
        <div class="mb-3">
            <label for="name">Наименование новой статьи дохода: </label>
            <input class="form-control shadow" type="text" name="name" value="" required>
        </div>
        <div class="mb-3">
            <label class="form-check-label" for="ispercent">Облагается процентом?: </label>
            <input class="form-check-input" type="checkbox" name="ispercent">
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary shadow-lg" name="incometype" value="incometype">Добавить</button>
            <br>
        </div>
    </div>
</form>
</body>
</html>
