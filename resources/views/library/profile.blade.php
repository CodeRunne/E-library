<x-dashboard-layout title="Profile">
    <main class="w-full relative flex flex-col lg:flex-row px-3 py-4 items-start">
        <!-- aside -->
        <x-book-aside/>
        
        <!-- books section -->
        <section class="w-full mt-8 lg:mt-0 lg:w-[70%] px-3">
            <section>
                <div class="text-sm mb-6">
                    <span class="font-bold underline decoration-dotted text-primary-900"><a href="{{ route('library.profile') }}">{{ auth()->user()->matric_no }}</a></span>
                    <span>/</span>
                    <span>My Profile</span>
                </div>
                <h3 class="text-2xl font-bold text-milk-900 border-b border-gray-300 pb-3">Profile</h3>

                @include('library.profile_partials.update-profile')

                @include('library.profile_partials.update-password')
            </section>
        </section>
    </main>
</x-dashboard-layout>