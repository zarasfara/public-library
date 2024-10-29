@php
    use Illuminate\Support\Str;
    use App\Models\Book;

    /* @var Book $book */
@endphp

<div class="card d-flex h-100">
    <img src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : $book->getImageUrl() }}"
         class="card-img-top " alt="book-image">
    <div class="card-body d-flex flex-column justify-content-between">
        <a href="{{route('books.details', $book)}}" class="card-title">{{$book->title}}</a>
        <p class="card-text">Автор: {{$book->author->getFullName()}}</p>
        <p class="card-text">Краткое описание: {{Str::words($book->description, 10)}}</p>
        @if($book->isAvailable() && (!Auth::check() || !$book->isCheckedOutByUser(Auth::user())))
            <form action="{{ route('checkout.book', $book->id) }}" method="post">
                @csrf
                <button class="btn btn-primary mt-auto align-self-start" type="submit" id="liveToastBtn">Оформить
                </button>
            </form>
        @else
            <button class="btn btn-secondary mt-auto align-self-start" disabled>Не доступно</button>
        @endif
    </div>
</div>
