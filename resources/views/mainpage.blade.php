<<<<<<< HEAD
<x-header/>
<x-app-layout/>
<div>
    <div class="d-flex flex-row justify-content-center">
        <h2>Главная страница</h2>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>
                <a href="/transaction">
                    <img src="images/newincome.png"
                        style="text-indent:-9999px;line-height:0;border:0;height:100px;width:100px;cursor:pointer;float:left;"/>
               </a>
            </div>
            <div class="text-center">
                <a href="/transaction">
                    Добавить проводку
                </a>
            </div>
        </div>
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>
                <a href="/budget-planning">
                    <img src="images/planbudget.jpg"
                        style="text-indent:-9999px;line-height:0;border:0;height:100px;width:100px;cursor:pointer;float:center;"/>
                </a>
            </div>
            <div class="text-center">
                <a href="/budget-planning">
                    Планирование бюджета
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>
                <a href="/refbooks">
                    <img src="images/library2.png"
                        style="text-indent:-9999px;line-height:0;border:0;height:100px;width:100px;cursor:pointer;float:left;">
                </a>
            </div>
            <div class="text-center">
                <a href="/refbooks">
                    Справочники
                </a>
            </div>
        </div>
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>
                <a href="/reports">
                    <img src="images/reports.jpg"
                        style="text-indent:-9999px;line-height:0;border:0;height:100px;width:100px;cursor:pointer;float:left;">
                </a>
            </div>
            <div class="text-center">
                <a href="/reports">
                    Отчеты
                </a>
            </div>
        </div>
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>
                <a href="/settings">
                    <img src="images/settings.jpg"
                         style="text-indent:-9999px;line-height:0;border:0;height:100px;width:100px;cursor:pointer;float:left;">
                </a>
            </div>
            <div class="text-center">
                <a href="/settings">
                    Настройки
                </a>
=======

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
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/add/expensetype')}}">
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
                <form name="expense" id="expense" method="post" enctype="multipart/form-data" action="{{url('/add/incometype')}}">
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
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
