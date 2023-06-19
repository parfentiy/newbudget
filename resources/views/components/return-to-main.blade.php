<div class="d-flex justify-content-center text-center bd-highlight">
    <form name="budget" id="budget" method="get" enctype="multipart/form-data" action="{{url('/mainpage')}}">
        @csrf
        <button type="submit" class="btn btn-primary justify-content-center text-center shadow-lg mt-2" name="action" value="date">На главную</button>
    </form>
</div>
