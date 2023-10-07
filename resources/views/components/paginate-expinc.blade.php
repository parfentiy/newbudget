@props([
'year' => 1970,
'month' => 1
])
@php
    $arr = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
@endphp

<div class="paginate-expinc">

    <div class="d-flex flex-row justify-content-around">
        <form name="previousmonth" method="post" enctype="multipart/form-data" action="{{url('/reports/currentexpenses')}}">
            @csrf
            <div class="form-group mt-3 text-center">
                <label for="date"></label>
                <input type="hidden" name="date" value="{{$year}}-{{$month}}">
                <button type="submit" class="btn btn-primary shadow-lg" name="action" value="previous">Предыдущий месяц</button>
                <br>
            </div>

        </form>

        <form name="nextmonth" method="post" enctype="multipart/form-data" action="{{url('/reports/currentexpenses')}}">
            @csrf
            <div class="form-group mt-3 text-center">
                <label for="date"></label>
                <input type="hidden" name="date" value="{{$year}}-{{$month}}">
                <button type="submit" class="btn btn-primary shadow-lg" name="action" value="next">Следующий месяц</button>
                <br>
            </div>
        </form>
    </div>
    <div class="d-flex flex-row justify-content-around">
        <b>{{$arr[$month-1]}} - {{$year}}</b>
    </div>
</div>
