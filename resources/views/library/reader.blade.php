<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reading - {{ $book->title }}</title>
	<!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
	
	<main>
		<nav class="h-[3.5rem] bg-gray-800 text-gray-50 px-4 flex items-center justify-center">
			<div>
				<h3><b>Reading -</b> <a href="{{ route('library.show', $book) }}" class="underline decoration-dotted">{{ $book->title }}</a></h3>
			</div>
		</nav>
		<section class="h-screen bg-gray-600 overflow-y-scroll relative flex justify-center" style="height: calc(100vh - 7rem);">
			<div class="content w-[55%] h-auto relative shadow">
				<canvas id="pdf-render" class="w-[100%] shrink-0"></canvas>
			</div>
		</section>
		<footer class="bg-gray-800 h-[3.5rem] text-gray-50 px-4 flex items-center justify-between">
			<div class="w-1/2 flex gap-2 justify-between items-center">
				<span class="page-info text-sm inline-block">
					Page <span id="page-num">0</span> of <span id="page-count">0</span>
				</span>
				<div class="flex divide-x divide-indigo-600">
					<button class="btn text-xs bg-primary-300 text-indigo-800 px-2 py-1 shadow rounded-tl-md rounded-bl-md" id="prev-page">
						Prev
					</button>
					<button class="btn text-xs bg-primary-300 text-indigo-800 px-2 py-1 shadow rounded-tr-md rounded-br-md" id="next-page">
						Next
					</button>
				</div>
				<input type="hidden" id="file" value="{{ asset('storage/'.$book->book) }}">
			</div>
		</footer>
	</main>


	<script src="{{ asset('pdfjs/pdf.js') }}"></script>
	<script src="{{ asset('pdfjs/pdf-viewer.js') }}"></script>
</body>
</html>