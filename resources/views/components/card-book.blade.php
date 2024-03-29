<div class="card d-flex h-100">
    <img src="..." class="card-img-top " alt="...">
    <div class="card-body">
        <h5 class="card-title">{{$book->title}}</h5>
        <p class="card-text">{{$book->author->getFullName()}}</p>
        <p class="card-text">{{\Illuminate\Support\Str::words($book->description, 10)}}</p>
        <a href="#" class="btn btn-primary">Забронировать</a>
    </div>
</div>
