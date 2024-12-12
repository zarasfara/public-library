@extends('admin.layouts.base')

@php
    /* @var $meta \App\Models\MetaTag */
@endphp

@section('title', 'Редактирование мета-тегов')

@section('content')
    <h1>Редактирование мета-тегов</h1>

    <form id="metaTagForm" method="POST" action="{{ route('meta-tags.update', $meta) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="card-body">
            <!-- Title -->
            <div class="form-group">
                <label for="metaTitle">Мета-тег - Title</label>
                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    id="metaTitle"
                    placeholder="Введите title..."
                    value="{{ old('title', $meta->title) }}">
                @error('title')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="metaDescription">Мета-тег - Description</label>
                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    id="metaDescription"
                    placeholder="Введите description...">{{ old('description', $meta->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Keywords -->
            <div class="form-group">
                <label for="metaKeywords">Мета-тег - Keywords</label>
                <input
                    type="text"
                    name="keywords"
                    class="form-control @error('keywords') is-invalid @enderror"
                    id="metaKeywords"
                    placeholder="Введите keywords..."
                    value="{{ old('keywords', $meta->keywords) }}">
                @error('keywords')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Robots -->
            <div class="form-group">
                <label for="metaRobots">Мета-тег - Robots</label>
                <input
                    type="text"
                    name="robots"
                    class="form-control @error('robots') is-invalid @enderror"
                    id="metaRobots"
                    placeholder="Введите robots..."
                    value="{{ old('robots', $meta->robots) }}">
                @error('robots')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
