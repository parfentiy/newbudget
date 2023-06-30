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
@include('layouts.app-rb-accounts')

<div class="d-flex flex-row justify-content-center">
    <table class="table table-bordered table-hover table-sm caption-top w-75">
    <caption>Категории</caption>
    <thead>
        <tr>
        <th scope="col">Название*</th>
        <th scope="col">Порядковый номер*</th>
        <th scope="col">Описание</th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($categories as $key => $category)
        <tr>
            <form class="align-text-top" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('account.update')}}">
            @csrf
                <td>
                    <input class="form-control form-control-sm" required type="text" name="name" value="{{$category->name}}"/>
                </td>
                <td>
                    <input class="form-control form-control-sm" required type="text" name="order_number" value="{{$category->order_number}}"/>
                </td>
                <td>
                    <input class="form-control form-control-sm" type="text" name="description" value="{{$category->description}}"/>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm align-text-top" name="id" value="{{$category->id}}">Обновить</button>
                </td>
            </form>
            <form name="" id="delete" method="post" enctype="multipart/form-data" action="{{route('account.delete')}}">
            @csrf
                <td>
                    <button type="submit" class="btn btn-danger btn-sm" name="id" value="{{$category->id}}">Удалить</button>
                </td>
            </form>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <form class="align-text-top" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('account.create')}}">
        @csrf
            <td>
                <input class="form-control form-control-sm" required type="text" name="name" value=""/>
            </td>
            <td>
                <input class="form-control form-control-sm" required type="text" name="order_number" value=""/>
            </td>
            <td>
                <input class="form-control form-control-sm" type="text" name="description" value=""/>
            </td>
            <td>
                <button type="submit" class="btn btn-primary btn-sm align-text-top" name="id" value="">Добавить</button>
            </td>
            <td>
            </td>
        </form>
    </tfoot>
    </table>
</div>
