<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Carts
        </h2>
    </x-slot>

        <div class="my-5 py-2 bg-white flex-col justify-center shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-auth-validation-errors class="mb-4 mt-2" :errors="$errors" />
            <x-success-message class="mt-2"></x-success-message>
            @forelse($carts as $cart)
                <div class="flex justify-center items-center py-2">
                    <x-product-cart
                        :cart="$cart">

                    </x-product-cart>
                </div>
            @empty
                <div class="flex justify-between">
                    <label for="price" class="block text-sm font-medium text-gray-700">There is no product :(</label>
                </div>
            @endforelse


        </div>
    <form method="POST" action="{{route('transaction.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="py-4">
            <input type="submit" value="Checkout IDR {{$carts->grand_total}}" class="mx-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"/>
        </div>
    </form>

</x-app-layout>
