<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customers
        </h2>
    </x-slot>

    <div class="my-5 py-2 bg-white flex-col justify-center shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="my-2 bg-white shadow overflow-hidden sm:rounded-md">
            @forelse($users as $user)
            <ul class="divide-y divide-gray-200">
                <li>
                    <a href="{{route('customer.detail', ['id' => $user->id])}}" class="block hover:bg-gray-50">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class="min-w-0 flex-1 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full" src="/storage/profile/{{$user->image}}" alt="">
                                </div>
                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-indigo-600 truncate">{{$user->name}}</p>
                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                            <!-- Heroicon name: solid/mail -->
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                            <span class="truncate">{{$user->email}}</span>
                                        </p>
                                    </div>
                                    <div class="hidden md:block ">
                                        <div>

                                            <p class="text-sm text-gray-900">
                                                Joined at
                                                <time datetime="2020-01-07">{{$user->created_at}}</time>
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                @if($user->deleted_at == null)
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Active
                                                @else
                                                <div class="flex items-center">
                                                    <div>
                                                        <img class="w-4 mr-2" src="/storage/icon/remove.svg">
                                                    </div>
                                                    <p class="text-sm text-gray-500">Suspend</p>
                                                </div>

                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>

            @empty
                <div class="flex justify-between">
                    <label for="price" class="block text-sm font-medium text-gray-700">There is no customer :(</label>
                </div>
            @endforelse
        </div>

    </div>

</x-app-layout>
