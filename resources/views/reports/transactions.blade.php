@props([
        'date_start' => '',
        'date_end' => '',
        'source_accs' => [],
        'dest_accs' => [],
        'amount_min' => '',
        'amount_max' => '',
        'is_set' => '',

])

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
    <style>
        form {
            margin: 1; /* Убираем отступы */
        }
    </style>
</head>

<x-header/>
@include('layouts.reports')
<form method="POST" action="{{ route('post.reports.transactions') }}">
    @csrf   
    <div class="d-flex flex-row justify-content-center">
        <input hidden type="number" name="is_set" value="1"/>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Начальная дата</label>
                <input class="form-control form-control-sm" type="date" name="date_start" value="{{$date_start ?? now()}}"/>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Конечная дата</label>
                <input class="form-control form-control-sm" type="date" name="date_end" value="{{$date_end ?? now()}}"/>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Источники</label>
                <select name="source_accs[]" multiple class="form-select form-select-sm">
                    @foreach($source_accs as $source_acc)
                        <option value="{{$source_acc}}">{{\App\Models\Account::find($source_acc)->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Зачисления</label>
                <select name="dest_accs[]" multiple class="form-select form-select-sm">
                    @foreach($dest_accs as $dest_acc)
                        <option value="{{$dest_acc}}">{{\App\Models\Account::find($dest_acc)->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Мин. сумма</label>
                <input class="form-control form-control-sm" type="number" name="amount_min" value="{{$amount_min ?? 0}}"/>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-top">
            <div>
                <label>Макс. сумма</label>
                <input class="form-control form-control-sm" type="number" name="amount_max" value="{{$amount_max ?? 0}}"/>
            </div>
        </div>
        <div class="d-flex flex-column mx-3 justify-content-center">
            <div >
                <label> </label>
                <div><button type="submit" class="btn btn-primary btn-sm" name="" value="">Применить</button> </div>
            </div>
        </div>
    </div>
</form>

<div class="d-flex flex-row my-3 justify-content-center">
    <form method="POST" action="{{ route('post.reports.transactions') }}">  
    @csrf  
    <div class="d-flex flex-row justify-content-center">

            <div>
                <label> </label>
                <div><button type="submit" class="btn btn-primary btn-sm" name="is_set" value="0">Сбросить фильтры</button> </div>
            </div>
        </div>
    </form>
</div>

<div class="d-flex flex-row justify-content-center">

    <table class="table table-bordered table-hover table-sm caption-top w-50 text-center align-center">
    <caption><h4 class="inline fw-weight-bolder">Операции</h4></caption>
    <thead>
        <tr>
        <th scope="col">Дата операции</th>
        <th scope="col">Счет-источник</th>
        <th scope="col">Счет зачисления</th>
        <th scope="col">Сумма</th>
        <th scope="col">Описание</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($transactions as $key => $transaction)
        <tr>
            <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('transaction.delete')}}">
            @csrf
                <td>
                    {{$transaction->operation_date}}
                </td>
                <td>
                    {{\App\Models\Account::find($transaction->source_account_id)->name}}
                </td>
                <td>
                    {{\App\Models\Account::find($transaction->dest_account_id)->name}}
                </td>
                <td>
                    {{$transaction->amount}} р.
                </td>
                <td>
                    {{$transaction->description}}
                </td>
                <td class="col-1 align-top">
                    <button type="submit" class="btn btn-danger btn-sm" name="id" value="{{$transaction->id}}">Удалить</button>
                </td>
            </form>
        </tr>
    @endforeach
    </tbody>
    
    </table>
</div>