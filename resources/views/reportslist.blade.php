@php
    use Jenssegers\Agent\Facades\Agent;
    $isDesktop = Agent::isDesktop();
@endphp
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Отчеты</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<x-return-to-main/>
<div class="container">
    <div class="text-center bd-highlight">
        <h2>Отчеты</h2>
    </div>
    <div class="p-2 d-grid">
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/reports/currentexpenses')}}" class="btn btn-primary shadow-lg">Показать расходы</a>
        </div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/reports/currentincomes')}}" class="btn btn-primary shadow-lg">Показать доходы</a>
        </div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/reports/currentbudget')}}" class="btn btn-primary shadow-lg">Бюджет</a>
        </div>
    </div>
</div>
</body>
</html>
