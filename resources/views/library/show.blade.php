<x-dashboard-layout :title="$book->title">
    <main class="w-full relative flex flex-col lg:flex-row px-3 py-4 items-start gap-x-3">
        <!-- aside -->
        <aside class="w-full lg:w-[30%] border border-gray-300 lg:h-[20rem] pb-12 order-2">
            <div>
                <h4 class="w-full p-2 text-sm font-bold bg-gray-300">Categories</h4>
                <ul class="px-2 mt-3">
                    @foreach($categories as $category)
                        <li class="py-[.2rem] px-1 border-b border-gray-300">
                            <a href="{{ route('library.category.show', $category) }}" class="block hover:bg-gray-300 p-1 rounded-sm ">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
        <!-- books section -->
        <section class="w-full mt-8 lg:mt-0 lg:w-[70%] px-3 lg:order-1">

            <section>
                <div class="text-sm">
                    <span><a href="{{ route('library.index') }}" class="underline decoration-dotted">Library</a></span>
                    <span>/</span>
                    <span class="font-bold">{{ $book->title }}</span>
                </div>

                <section class="w-full pl-6" style="margin-top: 2.5rem;">
                    <div class="flex flex-col lg:flex-row pt-2 {{ $issued != null ? 'items-center' : ''; }} gap-x-6 w-full h-auto">
                        <div class="relative w-[12rem] h-[15rem]">
                            <img src="{{ asset('storage/'.$book->cover) }}" class="h-[100%] w-[100%] object-cover rounded-sm shadow-sm">
                        </div>
                        <div class="flex flex-col gap-4 pt-0">
                            <div>
                                <p class="text-sm mb-2 font-normal text-milk-900">Book Title:</p>
                                <h3 class="capitalize text-gray-700">{{ $book->title }}</h3>
                            </div>
                            <div>
                                <p class="text-sm mb-2 font-normal text-milk-900">Book Author:</p>
                                <h3 class="capitalize text-gray-700">{{ $book->author }}</h3>
                            </div>
                            <div>
                                <p class="text-sm mb-2 font-normal text-milk-900">{{ $book->borrowed != true ? 'Borrow Book:' : ($issued != null ? 'Return Book:' : ''); }}</p>
                                @if (session('success'))
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-green-600 font-bold my-2"
                                        >{{ session('success') }}</p>
                                    @endif
                                @if($issued != null && $issued[0]->student_matric_number == auth()->user()->matric_no)
                                    <form action="{{ route('library.reader', $book) }}" method="GET" class="flex flex-col gap-y-2 mt-3">
                                        <button class="text-sm bg-sky-400 text-sky-50 px-2 w-[10rem]  h-[2rem] rounded-md focus:ring focus:ring-sky-400 focus:ring-offset-1 duration-250">Read Book</button>
                                    </form>
                                    <form action="{{ route('library.return', $book) }}" method="POST" class="flex flex-col gap-y-2 mt-3">
                                    @csrf
                                        <button class="text-sm bg-primary-400 text-primary-50 px-2 w-[10rem]  h-[2rem] rounded-md focus:ring focus:ring-primary-400 focus:ring-offset-1 duration-250">Return Book</button>
                                    </form>
                                @elseif($borrowed)
                                    <p class="text-sm text-red-500 w-[10rem] underline">Sorry Book Is Currently Unavailable!</p>
                                @else
                                    <form action="{{ route('library.borrow', $book) }}" method="POST" class="flex flex-col gap-y-2 mt-3">
                                    @csrf
                                        <input type="datetime-local" name="return_date" class="w-[10rem] h-[2rem] rounded border border-gray-400 text-gray-700">
                                        @error('return_date')
                                            <p class="text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                        <button class="text-sm bg-orange-400 text-orange-50 px-2 w-[10rem] h-[2rem] rounded-md focus:ring focus:ring-orange-400 focus:ring-offset-1 duration-250">Borrow Book</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 w-full lg:w-5/6">
                        <h4 class="underline font-bold text-gray-800">About This Book</h4>
                        <article class="text-md mt-3 text-gray-800">
                            {{ strip_tags(html_entity_decode($book->description)) }}
                        </article>
                    </div>
                </section>
            </section>

            <section class="mt-10 py-3">
                <h3 class="bg-milk-200 py-3 px-2 pl-4 font-bold text-lg text-gray-700">Related Books</h3>

                <section class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-x-3 gap-y-4 px-3 py-4">
                    @forelse($relatedBooks as $related)
                        <div class="">
                            <div class="w-[100%] bg-red-300 h-[12rem] rounded-sm shadow shadow-sm">
                                <img src="{{ asset('./storage/'.$related->cover) }}" alt="{{ $related->title }}" class="w-[100%] h-[100%] object-cover rounded-sm">
                            </div>
                            <div class="py-2 flex flex-col gap-y-3">
                                <span class="line-clamp-2 text-sm text-center text-gray-700">{{ $related->title }}</span>
                                <a href="{{ route('library.show', $related) }}" type="submit" class="bg-primary-400 text-primary-900 font-bold text-sm text-center w-full py-1 rounded-sm hover:bg-primary-500 focus:ring focus:ring-primary-400 focus:ring-offset-2 duration-250">View Book</a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-5 text-milk-900 px-1">No Related Books</p>
                    @endforelse
                </section>
            </section>
        </section>
    </main>
</x-dashboard-layout>