<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Fullname -->
        <div>
            <x-input-label for="fullname" :value="__('Fullname')" />
            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')"
                required autofocus autocomplete="fullname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
        </div>

        <!-- Matric Number -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Matric Number')" />
            <x-text-input id="matric_no" class="block mt-1 w-full" type="text" name="matric_no"
                :value="old('matric_no')" required autofocus autocomplete="matric_no" />
            <x-input-error :messages="$errors->get('matric_no')" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="department" :value="__('Department')" />
            <x-department-select id="department" class="block mt-1 w-full" name="department" :value="old('department')" required
                autocomplete="department" :departments='$departments' />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>


        <!-- Level -->
        <div class="mt-4">
            <x-input-label for="level" :value="__('Level')" />
            <x-level-select id="level" class="block mt-1 w-full" name="level" :value="old('level')" required
                autocomplete="level" :levels='$levels'/>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>