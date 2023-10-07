<html>
<head>
    <title>\File uploadt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<link rel="stylesheet" href="/css/app.css">

<h2>Введите ваши данные</h2>
<hr>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form name="login" id="login" method="post" enctype="multipart/form-data" action="{{route('auth')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Ваш email</label>
                    <input type="text" id="email" name="email" class="form-control" required="">
                    <br>
                    <label for="name">Пароль</label>
                    <input type="password" id="password" name="password" class="form-control" required="">
                </div>
                <button type="submit" class="btn btn-primary" name="done">Войти</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
