<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<script src="{{ mix('js/app.js') }}"></script>
	<title>{{ config('app.name') }}</title>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">

	<link rel="stylesheet"
      href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.1.2/build/styles/monokai-sublime.min.css">
	<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.1.2/build/highlight.min.js"></script>


	<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
	<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

	<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
			<a href="/" class="logo-link">notes</a>
		</div>
	</header>
	<main role="main">
		<div class="container">
			@yield('content')
		</div>
	</main>

	<footer>
		<div class="container">
			<span class="text-muted">laravel notes</span>
		</div>
	</footer>
	<script src="{{ URL::asset('js/custom.js') }}"></script>
</body>
</html>