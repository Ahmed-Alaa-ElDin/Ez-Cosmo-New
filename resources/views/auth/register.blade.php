<x-guest-layout>
    @include('includes.styles')
    <style>
        .select2-container .select2-selection--single .select2-selection__rendered {
            margin-top: 0!important;
        }
    </style>
    <x-auth-card class="m-4">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            </div>
            
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone Number')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>
            

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />

                <select name="gender" id="gender" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Gender</option>
                    <option value="1" @if (old('gender') == '1')
                        selected
                    @endif>Male</option>
                    <option value="2" @if (old('gender') == '2')
                        selected
                    @endif>Female</option>
                </select>
            </div>

            <!-- Country -->
            <div class="mt-4">
                <x-label for="country" :value="__('Country')" />

                <select name="country" id="country" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{$country->id}}" @if (old('country') == $country->id)
                            selected
                        @endif>{{$country->name ?? 'N/A'}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    @include('includes.scripts')
    <script>
        {{-- monoselect --}}
        $('#country').select2({
            theme: 'bootstrap4',
            dropdownAutoWidth: true,
            placeholder: 'Select Country'
        });

        $('#gender').select2({
            theme: 'bootstrap4',
            dropdownAutoWidth: true,
            minimumResultsForSearch: Infinity,
            placeholder: 'Select Gender'
        });

    </script>
</x-guest-layout>
