<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
	<nav class="py-2 bg-body-tertiary border-bottom"> 
		<div class="container d-flex flex-wrap"> 
			<ul class="nav me-auto"> 
				<li class="nav-item"><a href="/" class="nav-link link-body-emphasis px-2">Главная</a></li> 
			</ul> 
			<form class="d-flex" role="search" method="GET" action="">
				<input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" value="{{ request('query') }}">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>
			@if (Auth::guest())
				<ul class="nav"> 
					<li class="nav-item"><a href="/login" class="nav-link link-body-emphasis px-2">Вход</a></li> 
					<li class="nav-item"><a href="/register" class="nav-link link-body-emphasis px-2">Регистрация</a></li> 
				</ul>
			@else
				<p class="pt-2">{{ Auth::user()->name }}</p>
				<ul class="nav"> 
					<li class="nav-item"><a href="/cabinet/mybookings" class="nav-link link-body-emphasis px-2">Личный кабинет</a></li>
					<li class="nav-item"><a href="/logout" class="nav-link link-body-emphasis px-2">Выход</a></li> 
				</ul>
			@endif 
		</div> 
	</nav>

	@if (Auth::guest())
		<div class="bd-body-tertiary border rounded-3 p-2">
			@yield('content')
		</div>	
	@else
		<div class="container-fluid pb-3">
			<div class="d-grid gap-3" style="display: grid; grid-template-columns: 1fr 7fr;">
				<div class="bd-body-tertiary border rounded-3">
					@yield('sidebar')
				</div>
				<div class="bd-body-tertiary border rounded-3 p-2">
					@yield('content')
				</div>
			</div>
		</div>		
	@endif 


	<div class="container"> 
		<footer class="py-3 my-4">  
			<p class="text-center text-body-secondary">© 2025 myVideo</p> 
		</footer> 
	</div>
</body>
</html>