<x-guest-layout>

        <div class="min-h-screen bg-white flex">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div>
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                            Sign in to your account
                        </h2>
                    </div>
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="mt-8">
                        <div class="mt-6">
                                <div class="my-2 space-y-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email address
                                    </label>
                                    <div class="mt-1">
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                    </div>
                                </div>

                                <div class="my-2 space-y-1">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password
                                    </label>
                                    <div class="mt-2">
                                        <x-input id="password" class="block mt-1 w-full"
                                                 type="password"
                                                 name="password"
                                                 required autocomplete="current-password" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-between my-1">
                                    <div class="flex items-center">
                                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="text-sm">
                                        <a href="{{route('register')}}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            {{ __("Doesn't have an account ?") }}
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sign in
                                    </button>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="hidden lg:block relative w-0 flex-1">
                <img class="absolute inset-0 h-full w-full object-cover" src="/storage/banner/login.jpg" alt="">
            </div>
        </div>

</x-guest-layout>
