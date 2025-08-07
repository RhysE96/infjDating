<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information.") }}<br>
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div>
    </div>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>

            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->profile->name)" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-input-label class="mt-3" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <x-input-label class="mt-3" for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full" required >{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />

            <x-location-autocomplete :value="old('location_name', $user->profile->location_name ?? '')" />

            <div class="mt-4">
                <x-input-label for="looking_for" :value="__('Looking For type')" />
                    <div class="block mt-1 w-full">
                        <div class="flex items-center gap-4 mt-2 text-white">
                            <label for="looking_for_friendship" class="flex items-center gap-1">
                                <input type="checkbox" id="looking_for_friendship" name="looking_for_type[]" value="friendship" {{ in_array('friendship', old('looking_for_type', $user->profile->looking_for_type ?? [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2">{{ __('Friendship') }}</span>
                            </label>

                            <label for="looking_for_relationship" class="flex items-center gap-1">
                                <input type="checkbox" id="looking_for_relationship" name="looking_for_type[]" value="relationship" {{ in_array('relationship', old('looking_for_type', $user->profile->looking_for_type ?? [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
                            <input type="checkbox" id="looking_for_gender_male" name="looking_for_gender[]" value="male" {{ in_array('male', old('looking_for_gender', $user->profile->looking_for_gender ?? [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2">{{ __('Male') }}</span>
                        </label>

                        <label for="looking_for_gender_female" class="flex items-center gap-1">
                            <input type="checkbox" id="looking_for_gender_female" name="looking_for_gender[]" value="female" {{ in_array('female', old('looking_for_gender', $user->profile->looking_for_gender ?? [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2">{{ __('Female') }}</span>
                        </label>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <span>Your role is {{ $user->role }}</span>
            </p>

            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
