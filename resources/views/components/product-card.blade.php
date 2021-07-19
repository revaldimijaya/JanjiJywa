<section class="text-gray-700 body-font overflow-hidden bg-white rounded border border-gray-200">
    <div class="container px-2 py-2 mx-auto">
        <div class="mx-auto flex flex-col">
            <img alt="ecommerce" class="h-64 object-cover object-center rounded border border-gray-200" src="{{asset('/storage/beverage/'.$beverage->image)}}">
            <div class="flex flex-col">
                <h1 class="text-gray-900 text-xl title-font font-small mb-1 mt-1">{{$beverage->name}}</h1>
                <p class="leading-relaxed">{{ \Illuminate\Support\Str::limit($beverage->description, 25, $end='...') }}</p>
                <div class="flex items-center">
                    <span class="title-font font-small text-l text-green-500">Rp. {{$beverage->price}}</span>
                    @auth()
                    @if(auth()->user()->role->name === "Admin")
                        <button onclick="window.location='{{ route("manage.edit", ['id' => $beverage->id]) }}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Manage</button>
                    @elseif(auth()->user()->role->name === "Customer")
                        <button onclick="window.location='{{ route("beverage.detail", ['beverage' => $beverage->id]) }}'" class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">Order</button>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
