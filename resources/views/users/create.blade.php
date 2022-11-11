<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Kontak') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <article class="space-y-8">
                    <header>
                        <h2 class="text-xl font-black">- Kontak Details</h2>
                    </header>
                    <section class="w-full rounded-lg bg-white px-8 py-6 shadow space-y-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="given-name" autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="surname" :value="__('Surname')" />

                            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" autocomplete="family-name" required/>

                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="za_id_number" :value="__('South African ID Number')" />

                            <x-text-input id="za_id_number" class="block mt-1 w-full" type="text" name="za_id_number" :value="old('za_id_number')" required />

                            <x-input-error :messages="$errors->get('za_id_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="birth_date" :value="__('Birth Date')" />

                            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required  />

                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="mobile_number" :value="__('Mobile Number')" />

                            <x-text-input id="mobile_number" class="block mt-1 w-full" type="tel" name="mobile_number" :value="old('mobile_number')" required  />

                            <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="language" :value="__('Language')" />

                            <select name="language_id" id="language_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @foreach($languages as $language)
                                    <option value="{{ old('language_id')?? $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('language_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="interests" :value="__('Interests')" />

                            <select multiple name="interests[]" id="interests" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($interests as $interest)
                                    <option value="{{ old('interests')?? $interest->id }}">{{ $interest->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('interests')" class="mt-2" />
                        </div>
                        <div class="block mt-4">
                            <label for="is_admin" class="inline-flex items-center">
                                <input id="is_admin" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="is_admin">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Make this Kontak an Administrator') }}</span>
                                <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                            </label>
                        </div>
                    </section>
                    <footer>
                        <x-primary-button class="">
                            {{ __('Save Kontak') }}
                        </x-primary-button>
                    </footer>
                </article>
            </form>
        </div>
    </div>


</x-app-layout>
