@extends('layout')

@section('title')Мои видео @endsection

@section('sidebar')
<ul class="nav me-auto d-block">
	<li class="nav-item"><a href="/cabinet/myvideo" class="nav-link link-body-emphasis px-2">Мои видео</a></li>
	<li class="nav-item"><a href="/cabinet/load" class="nav-link link-body-emphasis px-2">Загрузить видео</a></li>
</ul>
@endsection

@section('content')
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
  <div>

</div>

@endsection