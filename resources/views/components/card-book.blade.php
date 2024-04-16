@php
    use Illuminate\Support\Str;
    use App\Models\Book;

    /* @var Book $book */
@endphp

<div class="card d-flex h-100">
    <img src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : $book->getImageUrl() }}" class="card-img-top " alt="book-image">
    <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title">{{$book->title}}</h5>
        <p class="card-text">Автор: {{$book->author->getFullName()}}</p>
        <p class="card-text">Краткое описание: {{Str::words($book->description, 10)}}</p>

        @if($book->isAvailable())
            <a href="#" class="btn btn-primary mt-auto align-self-start">Оформить</a>
        @else
            <a href="#" class="btn btn-secondary mt-auto align-self-start" disabled>Забронировать</a>
        @endif
    </div>
</div>
