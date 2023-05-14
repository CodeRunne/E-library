<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forbidden</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
	<div class="w-full min-h-screen flex justify-center items-center flex-col">
		<h1 class="text-primary-400 font-bold" style="font-size: 6rem;">403</h1>
		<div class="flex flex-col justify-center gap-y-4">
			<p class="text-gray-700 font-semibold">YOU DO NOT HAVE ACCESS TO VIEW THIS PAGE</p>
			<a href="{{ route('library.index') }}" class="bg-gray-600 text-primary-50 px-3 py-2 rounded-sm mx-auto text-sm">GO TO HOME</a>
		</div>
	</div>
</body>
</html>