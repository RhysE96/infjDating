<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Enter your name" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Birthdate -->
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" required />
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

        <!-- Location -->
        <div class="mt-4">
            <x-input-label for="location_name" :value="__('Location')" />
            <x-text-input id="location_name" class="block mt-1 w-full" type="text" name="location_name" required />
            <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <div class="block mt-1 w-full">
                <div class="flex items-center gap-4 mt-2 text-white">
                    <label for="gender_male" class="flex items-center gap-1">
                        <input type="radio" id="gender_male" name="gender" value="male" label="{{ __('Male') }}"  required />
                        <span class="ml-1">{{ __('Male') }}</span>
                    </label>
                    <label for="gender_female" class="flex items-center gap-1">
                        <input type="radio" id="gender_female" name="gender" value="female" label="{{ __('Female') }}"  required />
                        <span class="ml-1">{{ __('Female') }}</span>
                    </label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Bio -->    
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" class="block mt-1 w-full" name="bio" placeholder="Tell us about yourself" required autocomplete="bio"></textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Profile Image -->
        <div class="mt-4">
            <x-input-label for="profile_image" :value="__('Profile Picture')" />
            <input id="profile_image" name="profile_image" type="file" accept="image/*" class="text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div>

        <!-- Looking For type-->
        <div class="mt-4">
                <x-input-label for="looking_for" :value="__('Looking For type')" />
                <div class="block mt-1 w-full">
                    <div class="flex items-center gap-4 mt-2 text-white">
                        <label for="looking_for_friendship" class="flex items-center gap-1">
                            <input type="checkbox" id="looking_for_friendship" name="looking_for_type[]" value="friendship" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2">{{ __('Friendship') }}</span>
                        </label>

                        <label for="looking_for_relationship" class="flex items-center gap-1">
                            <input type="checkbox" id="looking_for_relationship" name="looking_for_type[]" value="relationship" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2">{{ __('Relationship') }}</span>
                        </label>
                    </div>
                </div>
            <x-input-error :messages="$errors->get('looking_for_type')" class="mt-2" />
        </div>

        <!-- Looking For gender -->  
        <div class="mt-4">
            <x-input-label for="looking_for_gender" :value="__('Looking For Gender')" />
            <div class="block mt-1 w-full">
                <div class="flex items-center gap-4 mt-2 text-white">
                    <label for="looking_for_gender_male" class="flex items-center gap-1">
                        <input type="checkbox" id="looking_for_gender_male" name="looking_for_gender[]" value="male" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">{{ __('Male') }}</span>
                    </label>

                    <label for="looking_for_gender_female" class="flex items-center gap-1">
                        <input type="checkbox" id="looking_for_gender_female" name="looking_for_gender[]" value="female" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">{{ __('Female') }}</span>
                    </label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
