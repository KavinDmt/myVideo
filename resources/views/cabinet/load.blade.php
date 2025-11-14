@extends('layout')

@section('title')Мои видео @endsection

@section('sidebar')
<ul class="nav me-auto d-block">
	<li class="nav-item"><a href="/cabinet/myvideo" class="nav-link link-body-emphasis px-2">Мои видео</a></li>
	<li class="nav-item"><a href="/cabinet/load" class="nav-link link-body-emphasis px-2">Загрузить видео</a></li>
</ul>
@endsection


@section('content')
<div class="container my-5">
    <h1 class="mb-4">Загрузка видео</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4 shadow-sm">
        <form action="{{ route('cabinet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок видео</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок" required>
            </div>
            
            <div class="mb-3">
                <label for="video" class="form-label">Выберите видео</label>
                <input class="form-control" type="file" id="video" name="video" accept="video/*" required>
            </div>

            <!-- Картинка / Миниатюра -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Выберите изображение (миниатюра)</label>
                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Загрузить</button>
        </form>
    </div>
</div>
@endsection