<form name="delete" id="expense" method="post" enctype="multipart/form-data" action="{{route('reportslist')}}">
    @csrf
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary shadow-lg" name="expense" value="expense">Назад к списку отчетов</button>
    </div>
</form>
