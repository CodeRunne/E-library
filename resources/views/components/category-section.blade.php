@foreach($sections as $section)
    <section class="py-3">
        <h3 class="bg-milk-200 py-3 px-2 pl-4 font-bold text-md text-gray-900 underline">{{ $section->name }}</h3>
        <section class="grid grid-cols-6 gap-x-3 gap-y-4 px-3 py-4">
            @forelse($section->books()->latest()->get() as $book)
                <div class="">
                    <div class="w-[100%] bg-red-300 h-[12rem] rounded-sm shadow shadow-sm">
                        <img src="{{ asset('./storage/'.$book->cover) }}" alt="{{ $book->title }}" class="w-[100%] h-[100%] object-cover rounded-sm">
                    </div>
                    <div class="py-2 flex flex-col gap-y-3">
                        <span class="line-clamp-2 text-sm text-center text-gray-700">{{ $book->title }}</span>
                        
                        <a href="{{ route('library.show', $book) }}" type="submit" class="bg-primary-400 text-primary-900 font-bold text-sm text-center w-full py-1 rounded-sm hover:bg-primary-500 focus:ring focus:ring-primary-400 focus:ring-offset-2 duration-250">View Book</a>
                    </div>
                </div>
            @empty
                <p class="col-span-5 text-milk-900 px-1 self-center">No Books In Shelf</p>
            @endforelse
        </section>
    </section>
@endforeach