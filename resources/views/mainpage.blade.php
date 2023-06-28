<x-header/>
<x-app-layout/>
<div>
    <div class="d-flex flex-row justify-content-center">
        Главная страница
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div>
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
        <div>
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
        <div>
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
</div>

