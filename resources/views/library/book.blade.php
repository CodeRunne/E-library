<x-dashboard-layout title="My Books">
    <main class="w-full relative flex flex-col lg:flex-row px-3 py-4 items-start">
        <!-- aside -->
        <x-book-aside/>
        
        <!-- books section -->
        <section class="w-full mt-8 lg:mt-0 lg:w-[70%] px-3">
            <section>
                <div class="text-sm mb-6">
                    <span class="font-bold underline decoration-dotted text-primary-900"><a href="{{ route('library.profile') }}">{{ auth()->user()->matric_no }}</a></span>
                    <span>/</span>
                    <span>My Books</span>
                </div>
                <h3 class="text-2xl font-bold text-milk-900 border-b border-gray-300 pb-3">My Books</h3>

                <div class="mt-6">
                    <h4 class="mb-5 font-bold text-gray-600">My Loans ({{ $books->count() }})</h4>
                    <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 gap-y-6">
                        @forelse($books as $loan)
                            <div>
                                <div class="bg-red-300 h-[12rem] mb-2">
                                    <img src="{{ asset('/storage/'.$loan->getBook($loan->book_id)->cover) }}" alt="cover" class="w-[100%] h-[100%] object-cover">
                                </div>
                                <div>
                                    <a href="{{ route('library.reader', $loan->getBook($loan->book_id)) }}" class="block text-orange-900 bg-orange-200 text-center text-sm py-2 font-bold rounded-sm focus:ring focus:ring-orange-400 focus:ring-offset-2 hover:bg-orange-300 duration-250">Read</a>
                                    <form action="{{ route('library.return', $loan->getBook($loan->book_id)) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="w-full text-gray-700 border-2 border-gray-400 text-center text-sm py-2 font-bold rounded-sm hover:bg-gray-700 hover:text-gray-300 duration-250">Return Book</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                        <p class="col-span-5 text-milk-900 px-1">No Loaned Books</p>
                        @endforelse

                    </div>
                </div>
            </section>

            <section class="mt-8 py-3 border-t border-gray-300">
                <h3 class="mb-5 font-bold text-gray-600">Recommended Books</h3>
                <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 gap-y-6">
                    @forelse($recommended as $book)
                        <div>
                            <div class="bg-red-300 h-[12rem] mb-2">
                                 <img src="{{ asset('/storage/'.$book->cover) }}" alt="cover" class="w-[100%] h-[100%] object-cover">
                            </div>
                            <div>
                                <a href="{{ route('library.show', $book) }}" class="block text-primary-900 bg-primary-200 text-center text-sm py-2 font-bold rounded-sm focus:ring focus:ring-primary-400 focus:ring-offset-2 hover:bg-primary-300 duration-250">View Book</a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-5 text-milk-900 px-1">No Recommended Books</p>
                    @endforelse
                </div>
            </section>

            <!-- <section class="mt-8 py-3">
                <h3>Browse By Subject</h3>
            </section> -->
        </section>
    </main>
</x-dashboard-layout>