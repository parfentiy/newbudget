<html>
<head>
    <title>Отправка сообщения</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<x-header/>
<x-return-to-main/>
<body>
<div class="container text-center">
    <h2>Отправщик сообщений</h2>
</div>
<form class="container" name="message" id="newincome" method="post" enctype="multipart/form-data" action="{{url('/sender')}}">
    @csrf
    <div class="p-5">
        <div class="mb-3">
            <label for="message">Текст сообщения: </label>
            <input type="text" id="message" name="message" class="form-control shadow" required>
        </div>

        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary shadow-lg" name="action" value="income">Отправить</button>
            <br>
        </div>
    </div>
</form>
</body>
</html>

