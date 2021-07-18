<x-app-layout>
    <x-slot name="header">
        <form action="/">
        <div class="flex rounded-full border-grey-light border">
            <button type="submit">
              <span class="w-auto flex justify-center outline-none items-center text-grey py-2 px-4">
                  <i class="fas fa-search"></i>
              </span>
            </button>
            <input name="search" class="w-full border-none rounded mr-4" value="{{old('search')?? ''}}" type="search" placeholder="Search...">

        </div>
        </form>
    </x-slot>
    <div class="my-5 bg-white shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 auto-rows-auto gap-x-4 gap-y-4 items-center justify-center">
            @forelse($beverages as $beverage)
                <x-product-card
                    :beverage="$beverage"
                    >

                </x-product-card>

            @empty
                <div class="flex justify-between">
                    <label for="price" class="block text-sm font-medium text-gray-700">There is no product :(</label>
                </div>
            @endforelse
            {{$beverages->links()}}
        </div>
    </div>
</x-app-layout>
