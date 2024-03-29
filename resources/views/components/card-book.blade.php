@php
    use Illuminate\Support\Str;
    use App\Models\Book;

    /* @var Book $book */
@endphp

<div class="card d-flex h-100">
    <img src="https://placehold.co/600x400" class="card-img-top " alt="...">
    <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title">{{$book->title}}</h5>
        <p class="card-text">Автор: {{$book->author->getFullName()}}</p>
        <p class="card-text">Краткое описание: {{Str::words($book->description, 10)}}</p>

        @if($book->available > 0)
            <a href="#" class="btn btn-primary mt-auto align-self-start">Забронировать</a>
        @else
            <button class="btn btn-secondary mt-auto align-self-start" disabled>Недоступно</button>
        @endif
    </div>
</div>
