<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Beverages
        </h2>
    </x-slot>
    <div class="my-5 bg-white shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 auto-rows-auto gap-x-4 gap-y-4 items-center justify-center">
            @foreach($beverages as $beverage)
                <x-product-card
                    :name="$beverage->name"
                    :description="$beverage->name"
                    :price="$beverage->price"
                    :image="$beverage->image">

                </x-product-card>
            @endforeach

        </div>
    </div>
</x-app-layout>
