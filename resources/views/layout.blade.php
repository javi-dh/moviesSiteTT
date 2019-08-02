<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="/css/app.css">
	</head>
	<body>
		@include('partials.navbar')

		<div class="container" style="margin-top: 40px;">
			@yield('content')
		</div>

		<script src="/js/app.js"></script>
	</body>
</html>
