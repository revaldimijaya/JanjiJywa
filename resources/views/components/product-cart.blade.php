
<div class="lg:w-4/5 md:w-full md:px-4 flex justify-center items-center p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-200" style="">
    <div class="flex w-24">
        <img src="/storage/beverage/{{$cart->image}}">
    </div>
    <div class="flex-auto text-sm w-32 ml-4">
        <div class="font-bold py-2">{{$cart->name}}</div>
        <div class="truncate py-2">{{$cart->description}}</div>
        @if($cart->ice_id != "")
            <div class="py-1/2">
                <div class="truncate">Ice Level</div>
                <div class="truncate text-gray-400">{{$cart->ice_name}}</div>
            </div>
        @endif
        @if($cart->sugar_id != "")
            <div class="py-1/2">
                <div class="truncate">Sugar Level</div>
                <div class="truncate text-gray-400">{{$cart->sugar_name}}</div>
            </div>
        @endif
        @if($cart->topping_id != "")
            <div class="pt-1/2">
                <div class="truncate">Topping</div>
            </div>
        @endif
        @foreach($cart->toppings as $topping)
            <div class="truncate text-gray-400">{{$topping->name}}</div>
        @endforeach

        <div class="text-gray-600 py-2">
            <div class="custom-number-input w-32">
                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                    <form method="POST" action="{{route('cart.quantity', ['id' => $cart->id, 'qty' => $cart->quantity - 1])}}">
                        @csrf
                        <button  data-action="decrement" class=" bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 rounded-l cursor-pointer outline-none">
                            <span class="m-auto text-2xl font-thin">−</span>
                        </button>
                    </form>
                    <input type="number" class="border-none outline-none focus:outline-none text-center w-full bg-gray-200 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700 outline-none" name="quantity[]" value="{{$cart->quantity}}"/>
                    <form method="POST" action="{{route('cart.quantity', ['id' => $cart->id, 'qty' => $cart->quantity + 1])}}">
                        @csrf
                        <button data-action="increment" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 rounded-r cursor-pointer">
                            <span class="m-auto text-2xl font-thin">+</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <style>
            input[type='number']::-webkit-inner-spin-button,
            input[type='number']::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .custom-number-input{
                outline: none;
            }

            .custom-number-input input:focus {
                outline: none !important;
            }

            .custom-number-input button:focus {
                outline: none !important;
            }
        </style>


    </div>
    <div class="h-60 flex">
        <div class="flex flex-col justify-between w-18 font-medium items-end">
            <div class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700">
            <form method="POST" action="{{route('cart.destroy', ['id' => $cart->id])}}">
                @csrf
                <input type="hidden" name="_method" value="delete" />
                <button>

                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>

                </button>
            </form>
            </div>
            @if($cart->sub_total > 0)
                <div class="text-green-600" class="price" data-action="pr" >IDR {{$cart->sub_total}}</div>
            @endif

        </div>
    </div>
</div>
