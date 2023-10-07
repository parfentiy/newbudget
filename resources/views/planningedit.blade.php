<head>
    <title>Планирование бюджета на {{$month}}-{{$year}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>
<a name="top"></a>
<x-header/>
<div class="d-flex flex-row justify-content-around">
    <form  name="delete" id="expense" method="post" enctype="multipart/form-data" action="{{url('/planning')}}">
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="expense" value="expense">Назад</button>
            <br>
        </div>
    </form>
    <div>
        <x-return-to-main/>
    </div>
</div>

<div class="container d-flex flex-row justify-content-center">
    <h2>Планирование бюджета на {{$month}}-{{$year}}</h2>
</div>

<table class="container d-flex flex-row justify-content-center" style="border: 1px solid white; border-collapse: collapse">
    <tr>
        <th style="border: 1px solid; text-align: center; padding: 3px;">#</th>
        <th style="border: 1px solid; text-align: center; ">Статья расхода</th>
        <th style="border: 1px solid; text-align: center; ">Сумма (план.)</th>
        <th style="border: 1px solid; text-align: center; ">Сумма (потрачено)</th>
        <th style="border: 1px solid; text-align: center; ">Процентная статья</th>
        <th style="border: 1px solid; text-align: center; ">Размер в %</th>
        <th style="border: 1px solid; text-align: center; ">Порядковый номер</th>
    </tr>
    @php
        $count=0;
    @endphp
    @foreach($budgetItems as $budgetItem)
        @php
            $count++;
        @endphp

        <tr>
        <form name="{{$count}}" id="expense" method="post" enctype="multipart/form-data" action="{{route('planningsave', [$year, $month])}}">
                @csrf
            <td style="border: 1px solid;">{{$count}}</td>
            <td style="border: 1px solid;">
                {{$expTypes[$count-1]['name']}}

            </td>
            <td style="border: 1px solid; text-align: center;">
                <input type="text" value="{{$expTypes[$count-1]['sum']}}" name="sum">
                <input type="hidden" value="{{$expTypes[$count-1]['id']}}" name="expensestypes_id">
            </td>
            <td style="border: 1px solid; text-align: center;">{{$expTypes[$count-1]['sumWasted']}}</td>
            <td style="border: 1px solid; text-align: center;">
                @if($expTypes[$count-1]['is_percent'] === 1)
                    ✓
                @endif
            </td>
            <td style="border: 1px solid; text-align: center;">{{$expTypes[$count-1]['percent']}}
            </td>
            <td style="border: 1px solid; text-align: center;">
                <input type="text" value="{{$expTypes[$count-1]['ordernum']}}" name="ordernum">
            </td>
            <td style="border: 1px solid;">
                <button type="submit" class="btn btn-primary" name="expenseid" value="{{$budgetItem['id']}}">Сохранить</button>
            </td>
        </form>
        <form name="delete" id="delete" method="post" enctype="multipart/form-data" action="{{url('/planning/delete')}}">
            @csrf
            <td style="border: 1px solid;">
                <button type="submit" class="btn btn-primary" name="expenseid" value="{{$budgetItem['id']}}">Удалить</button>
            </td>
        </form>
        </tr>
    @endforeach

    <form name="create" id="create" method="post" enctype="multipart/form-data" action="{{route('planningcreate', [$year, $month])}}">
        @csrf
        <td style="border: 1px solid;">{{$count+1}}</td>
        <td style="border: 1px solid;">
            <select name="expType" id="expType">
                @foreach($expensesTypes as $expensesType)
                    <option value="{{$expensesType['id']}}">{{$expensesType['name']}}</option>
                @endforeach
            </select>
        </td>
        <td style="border: 1px solid; text-align: center;">
            <input type="text" value="" name="sum">
        </td>
        <td style="border: 1px solid; text-align: center;">
        </td>
        <td style="border: 1px solid; text-align: center;">
        </td>
        <td style="border: 1px solid; text-align: center;">
        </td>
        <td style="border: 1px solid; text-align: center;">
            <input type="text" value="" name="ordernum">
        </td>
        <td style="border: 1px solid;">
            <button type="submit" class="btn btn-primary" name="expenseid" value="">Добавить</button>
        </td>

    </form>
</table>
<x-return-to-top/>



