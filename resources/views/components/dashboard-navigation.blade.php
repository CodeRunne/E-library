<nav class="h-[3rem] flex items-center justify-between px-3">
    <div>
        <a href="{{ route('library.index') }}" class="inline-block font-bold text-sm lg:text-md bg-primary-500 py-1 px-2 text-primary-200 rounded-sm" style="transform: rotate(-5deg);">E-Books</a>
    </div>
    <!-- form -->
    <div>
        <form action="{{ route('library.search') }}" class="group flex items-stretch">
            <input type="text" class="w-[11rem] lg:w-[14rem] h-[2rem] outline-none border border-gray-300 rounded-tl-md rounded-bl-md text-sm focus:ring focus:ring-primary-300 focus:ring-offset-0 focus:border-gray-300 caret-indigo-500" name="search" placeholder="Search Books, Author" style="outline: none;">
            <button type="submit" class="text-xs bg-gray-300 px-2 rounded-tr-md rounded-br-md text-gray-700 focus:ring focus:ring-primary-300 focus:ring-offset-0 focus:border-gray-300">search</button>
        </form>
    </div>
    <div class="flex items-center gap-1 lg:gap-0">
        <a href="{{ route('library.books') }}" class="text-[.9rem] text-gray-600 underline decoration-dotted hover:decoration-primary-600 hover:text-primary-600 pr-2">My Books</a>
        @guest
            <div class="text-sm pl-2 text-gray-600">
                <a href="/login" class="bg-primary-400 text-primary-50 hover:underline px-1 duration-250">Log In</a>
                <span>or</span>
                <a href="/register" class="underline px-1 hover:bg-orange-300 hover:text-orange-50 duration-250">Signup</a>
            </div>
        @endguest

        @auth
            <div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ auth()->user()->fullname }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>