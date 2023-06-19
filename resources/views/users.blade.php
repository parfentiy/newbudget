<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
</head>

<body>
<h2>Список пользователей</h2>
<hr>

<table border="1">
    @foreach($users as $item)
        <tr><td>{{$item['email']}}</td></tr>
    @endforeach
</table>
</body>

</html>
