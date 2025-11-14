@extends('layout')

@section('title')Главная @endsection

@section('sidebar')
<ul class="nav me-auto d-block">
	<li class="nav-item"><a href="/cabinet/myvideo" class="nav-link link-body-emphasis px-2">Мои видео</a></li>
	<li class="nav-item"><a href="/cabinet/load" class="nav-link link-body-emphasis px-2">Загрузить видео</a></li>
</ul>
@endsection

@section('content')

<div class="container my-4">
    <!-- Форма сортировки -->
    <form method="GET" action="" class="row gy-2 gx-3 align-items-center mb-4">
        <div class="col-md-4">
            <label for="sort" class="form-label">Сортировать по:</label>
            <select class="form-select" id="sort" name="sort">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>--</option>
                <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>По дате (новое - старое)</option>
                <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>По дате (старое - новое)</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>По названию (А-Я)</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>По названию (Я-А)</option>
                <option value="countLike_desc" {{ request('sort') == 'countLike_desc' ? 'selected' : '' }}>По количеству лайков (больше - меньше)</option>
                <option value="countLike_asc" {{ request('sort') == 'countLike_asc' ? 'selected' : '' }}>По количеству лайков (меньше - больше)</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100 mt-4 mt-md-0">Применить</button>
        </div>
    </form>
</div>

<div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
           
           
            @if($newVideo->isEmpty())
                <p>Видео не найдены</p>
            @else
                @foreach($newVideo as $video)
                    @include('video.item', ['video'=>$video])
                @endforeach
            @endif
            </div>
        </div>
  </div>
@endsection