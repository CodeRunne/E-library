<aside class="w-full lg:w-[30%] bg-gray-200 lg:h-[40rem] pb-12">
    <div>
        <h4 class="w-full p-2 text-sm font-bold bg-gray-300">{{ auth()->user()->fullname }}</h4>
        <ul class="px-2 mt-3">
            <li class="py-[.2rem] px-1 border-b border-gray-300">
                <a href="{{ route('library.profile') }}" class="block {{ request()->routeIs('library.profile') ? 'bg-gray-300' : ''; }} hover:bg-gray-300 p-1 rounded-sm ">Profile</a>
            </li>
            <li class="py-[.2rem] px-1 border-b border-gray-300">
                <a href="{{ route('library.books') }}" class="block p-1 rounded-sm {{ request()->routeIs('library.books') ? 'bg-gray-300' : ''; }} hover:bg-gray-300">Loans</a>
            </li>
            <li class="py-[.2rem] px-1">
                <a href="{{ route('library.history') }}" class="block hover:bg-gray-300 p-1 rounded-sm {{ request()->routeIs('library.history') ? 'bg-gray-300' : ''; }}">Loan History</a>
            </li>
        </ul>
    </div>
</aside>