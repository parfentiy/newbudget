
<html>
<head>
    <title>Бюджет. Главная страница</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<body>
<x-header/>
<div style="display: flex; align-items: center; justify-content: center" class="card-body">
    <h1>ГЛАВНАЯ СТРАНИЦА</h1>
</div>
<div>
    <div style="display: flex; justify-content: center;">
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/add/expense')}}">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/newexpense.jpg');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div style="margin: 0px;">
                <h2>Добавить расход</h2>
            </div>
        </div>
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/add/income')}}">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/newincome.png');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div>
                <h2>Добавить доход</h2>
            </div>
        </div>
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/planning')}}">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/planbudget.jpg');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div>
                <h2>Планирование бюджета</h2>
            </div>
        </div>
    </div>
    <div style="display: flex; justify-content: center;">
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="/add/expensetype">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/newexpensetype.png');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div>
                <h2>Новая статья расходов</h2>
            </div>
        </div>
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="/add/incometype">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/newincometype.png');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div>
                <h2>Новая статья доходов</h2>
            </div>
        </div>
    </div>
    <div style="display: flex; justify-content: center;">
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; padding: 10;">
            <div>
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/reportslist')}}">
                    @csrf
                    <input id="go" type="submit"
                           style="text-indent:-9999px;line-height:0;border:0;background:url('images/reports.png');height:150px;width:150px;cursor:pointer;float:left;"/>
                </form>
            </div>
            <div>
                <h2>Отчеты</h2>
            </div>
        </div>
    </div>
</div>
