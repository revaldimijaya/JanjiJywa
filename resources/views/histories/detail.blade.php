<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            History
        </h2>
    </x-slot>

    <div class="my-5 py-2 bg-white flex-col justify-center shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        @forelse($details as $detail)
            <div class="flex justify-center items-center py-2">
                <div class="lg:w-4/5 md:w-full md:px-4 flex justify-center items-center p-2 flex bg-white border-b border-gray-200" style="">
                    <div class="flex w-24">
                        <img src="{{asset('/storage/profile/'.$detail->image}}">
                    </div>
                    <div class="flex-auto text-sm w-32 ml-4">
                        <div class="font-bold py-2">{{$detail->name}}</div>
                        <div class="truncate py-2">{{$detail->description}}</div>
                        @if($detail->ice_id != "")
                            <div class="py-1/2">
                                <div class="truncate">Ice Level</div>
                                <div class="truncate text-gray-400">{{$detail->ice_name}}</div>
                            </div>
                        @endif
                        @if($detail->sugar_id != "")
                            <div class="py-1/2">
                                <div class="truncate">Sugar Level</div>
                                <div class="truncate text-gray-400">{{$detail->sugar_name}}</div>
                            </div>
                        @endif
                        @if($detail->topping_id != "")
                            <div class="pt-1/2">
                                <div class="truncate">Topping</div>
                            </div>
                        @endif
                        @foreach($detail->toppings as $topping)
                            <div class="truncate text-gray-400">{{$topping->name}}</div>
                        @endforeach

                        <div class="py-1/2">
                            <div class="truncate">Quantity</div>
                            <div class="truncate text-gray-400">{{$detail->quantity}}</div>
                        </div>

                    </div>
                    <div class="h-56 flex">
                        <div class="flex flex-col justify-between w-18 font-medium items-end">
                            @if($detail->sub_total > 0)
                                <div class="text-green-600" class="price" data-action="pr" >IDR {{$detail->sub_total}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse

    </div>
</x-app-layout>
