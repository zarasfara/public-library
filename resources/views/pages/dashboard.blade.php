@extends('layouts.base')

@use(Illuminate\Support\Facades\Auth)

@section('title', 'Личный кабинет')

@section('content')
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Фото профиля</span>
            </h4>
            @if(Auth::user()->avatar !== null)
                <img src="{{ Auth::user()->avatar }}" alt="profile-photo" style="max-width: 100%;">
            @else
                <p class="text-danger">Фото отсутствует</p>
            @endif
        </div>
        <div class="col-md-7 col-lg-8">
            <h2>Личные данные</h2>
            <form method="POST" class="needs-validation" action="{{route('update.profile')}}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label for="firstName" class="form-label">Имя</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               id="firstName">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               id="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Пароль</label>
                        <input name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Фото профиля</label>
                        <input name="avatar" class="form-control @error('avatar') is-invalid @enderror" type="file"
                               id="formFile">
                        @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
            </form>
            <h2 class="my-4">Взятые книги</h2>

            @if(\Auth::user()->reservedBooks->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    <strong>Вы ничего не оформляли.</strong>
                </div>
            @else
                <ul class="list-group">
                    @foreach(\Auth::user()->reservedBooks as $book)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">{{ $book->title }}</h5>
                            </div>
                            <ul class="list-group">
                                @foreach($book->bookCheckouts as $bookCheckout)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        @if($bookCheckout->is_returned)
                                            <span class="text-success fw-bold">Возвращена</span>
                                        @else
                                            <span
                                                class="{{ $bookCheckout->isOverdue() ? 'text-danger fw-bold' : 'text-secondary' }}">
                                                @if($bookCheckout->isOverdue())
                                                    <i class="fas fa-exclamation-circle"></i> Просрочено
                                                @else
                                                    Вернуть к {{ $bookCheckout->return_date->format('d.m.Y') }}
                                                @endif
                                            </span>
                                            <span class="badge bg-{{ $bookCheckout->isOverdue() ? 'danger' : 'info' }}">
                                                {{ $bookCheckout->return_date->diffForHumans() }}
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
@endsection


