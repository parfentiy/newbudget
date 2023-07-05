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