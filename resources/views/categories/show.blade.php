<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
</head>

<x-header/>
@include('layouts.app-rb-accounts')

<div>
    <div class="d-flex flex-row justify-content-center">
        Категории
    </div>
    @foreach ($categories as $key => $category)
        <div class="d-flex flex-row justify-content-center">
            <form name="" id="category" method="post" enctype="multipart/form-data" action="{{route('account.save')}}">
            @csrf
                <div style="border: 1px solid;" class="d-flex flex-row justify-content-center">
                    <div style="border: 1px solid;" class="d-flex flex-row justify-content-center">
                        <input type="text" name="name" value="{{$category->name}}"/>
                    </div>
                    <div style="border: 1px solid;" class="d-flex flex-row justify-content-center">
                        <input type="text" name="order_number" value="{{$category->order_number}}"/>
                    </div>

                    <div style="border: 1px solid;" class="d-flex flex-row justify-content-center">
                        <button type="submit" class="btn btn-primary" name="id" value="{{$category->id}}">Изменить</button>
                    </div>
                </div>
            </form>
            <form name="" id="delete" method="post" enctype="multipart/form-data" action="{{route('account.delete')}}">
            @csrf
                <div style="border: 1px solid;" class="d-flex flex-row justify-content-center">
                    <button type="submit" class="btn btn-primary" name="id" value="{{$category->id}}">Удалить</button>
                </div>
            </form>
        </div>
    @endforeach
</div>
