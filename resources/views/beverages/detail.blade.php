<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Beverage
        </h2>
    </x-slot>
    <form method="POST" action="{{route('cart.store', ['beverage' => $beverage])}}" enctype="multipart/form-data">
        @csrf
        <div class="my-5 bg-white shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="text-gray-700 body-font overflow-hidden bg-white">
                <div class="container px-5 py-24 mx-auto">
                    <x-success-message></x-success-message>
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <img alt="ecommerce" class="lg:w-1/2 w-full object-none object-center rounded border border-gray-200" src="/storage/beverage/{{$beverage->image}}">
                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <x-auth-validation-errors :value="$errors"></x-auth-validation-errors>

                            <h2 class="text-sm title-font text-gray-500 tracking-widest">BEVERAGE NAME</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$beverage->name}}</h1>
                            <p class="leading-relaxed">{{$beverage->description}}</p>
                            @if($beverage->custom_ice == "true")
                                <fieldset class="py-4">
                                    <div class="flex justify-between">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Ice Level</label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        @foreach($ices as $ice)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="{{$ice->id}}" value="{{$ice->id}}" name="ice" type="radio" class="checked:bg-green-600 h-4 w-4 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{$ice->id}}" class="font-medium text-gray-700">{{$ice->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endif

                            @if($beverage->custom_sugar == "true")
                                <fieldset class="py-4">
                                    <div class="flex justify-between">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Sugar Level</label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        @foreach($sugars as $sugar)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="{{$sugar->id}}" value="{{$sugar->id}}" name="sugar" type="radio" class="checked:bg-green-600 h-4 w-4 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{$sugar->id}}" class="font-medium text-gray-700">{{$sugar->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </fieldset>
                            @endif

                            @if($beverage->custom_topping == "true")
                                <fieldset class="py-4">
                                    <div class="flex justify-between">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Topping</label>
                                        <span class="text-sm text-gray-500" id="email-optional">Optional, max 2</span>
                                    </div>
                                    <div class="mt-4 space-y-4 topping-levels">
                                        @foreach($toppings as $topping)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="{{$topping->id}}" value="{{$topping->price}}#{{$topping->id}}" name="topping[]" type="checkbox" class="checked:bg-green-600 h-4 w-4 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{$topping->id}}" class="font-medium text-gray-700">{{$topping->name}} (+ IDR {{$topping->price}})</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </fieldset>
                            @endif

                            <div class="py-4">
                                <div class="flex justify-between">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <span class="text-sm text-gray-500" id="quantity">Required, stock {{$beverage->stock}}</span>
                                </div>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" min="1" name="quantity" id="quantity" class="focus:ring-indigo-400 focus:border-indigo-400 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="price-currency">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm" id="price-currency">
                                    QTY
                                  </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <span id="price" class="title-font font-medium text-2xl text-gray-900">IDR {{$beverage->price}}</span>
                                <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to Cart</button>
                            </div>

                            <script>
                                var theCheckboxes = $(".topping-levels input[type='checkbox']");

                                theCheckboxes.click(function()
                                {
                                    if (theCheckboxes.filter(":checked").length > 2){
                                        $(this).removeAttr("checked");
                                    }
                                    let price = {{$beverage->price}}
                                    $('.topping-levels input[type=\'checkbox\']:checked').each(function() {
                                        price += parseInt(this.value.split("#")[0])
                                    });
                                    $('#price').html("IDR " + price);
                                });
                            </script>


                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</x-app-layout>
