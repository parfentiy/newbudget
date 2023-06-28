<head>
    <title>Бюджет. Главная страница</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>

<div class="d-flex flex-row justify-content-between">
    <div>
        <b>Семейный бюджет. Автор Парфентий Петр</b>
    </div>
    <div>
        <b>Сегодня:
            @php
                $tz = 'Europe/Moscow';
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
                $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
                echo $dt->format('d.m.Y, H:i:s');
            @endphp
        </b>
    </div>
    <div>
        <b>Версия 1.0.7</b>
    </div>
</div>
<hr>
