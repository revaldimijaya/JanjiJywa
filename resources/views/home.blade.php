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

    <div class="my-5 overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 bg-indigo-600">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
        <span class="flex p-2 rounded-lg bg-indigo-800">
          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
          </svg>
        </span>
                    <p class="ml-3 font-medium text-white truncate">
          <span class="md:hidden">
            We announced a new beverage!
          </span>
                        <span class="hidden md:inline">
            Big news! We're excited to announce a brand new beverage.
          </span>
                    </p>
                </div>
                <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                    <a href="https://www.instagram.com/kopijanjijiwa/?hl=en" target="_blank" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
                        Learn more
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="sliderAx h-auto">
            <div id="slider-1" class="container mx-auto">
                <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url({{asset('/storage/banner/banner1.jpg')}})">
                    <div class="md:w-1/2">
                        <p class="font-bold text-sm uppercase">Welcome to</p>
                        <p class="text-3xl font-bold">Janji Jywa</p>
                        <p class="text-2xl mb-10 leading-none">Beverage Shop</p>
                        <a href="{{route('about')}}" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">About Us</a>
                    </div>
                </div> <!-- container -->
                <br>
            </div>

            <div id="slider-2" class="container mx-auto">
                <div class="bg-cover bg-top  h-auto text-white py-24 px-10 object-fill" style="background-image: url({{asset('/storage/banner/banner3.jpg')}})">
                    <div class="md:w-1/2">
                    <p class="font-bold text-sm uppercase">View your profile</p>
                    <p class="text-3xl font-bold">Janji Jywa</p>
                    <p class="text-2xl mb-10 leading-none">Below</p>
                        @auth()
                            <a href="{{route('account.profile')}}" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Profile</a>
                        @endauth
                        @guest()
                            <a href="{{route('login')}}" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Login</a>
                        @endguest
                </div>
                </div> <!-- container -->
                <br>
            </div>
        </div>
        <div  class="flex justify-between w-12 mx-auto pb-2">
            <button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2 " ></button>
            <button id="sButton2" onclick="sliderButton2() " class="bg-purple-400 rounded-full w-4 p-2"></button>
        </div>
    </div>

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
        </div>
    </div>

    <script>
        var cont=0;
        function loopSlider(){
            var xx= setInterval(function(){
                switch(cont)
                {
                    case 0:{
                        $("#slider-1").fadeOut(400);
                        $("#slider-2").delay(400).fadeIn(400);
                        $("#sButton1").removeClass("bg-purple-800");
                        $("#sButton2").addClass("bg-purple-800");
                        cont=1;

                        break;
                    }
                    case 1:
                    {

                        $("#slider-2").fadeOut(400);
                        $("#slider-1").delay(400).fadeIn(400);
                        $("#sButton2").removeClass("bg-purple-800");
                        $("#sButton1").addClass("bg-purple-800");

                        cont=0;

                        break;
                    }


                }},8000);

        }

        function reinitLoop(time){
            clearInterval(xx);
            setTimeout(loopSlider(),time);
        }



        function sliderButton1(){

            $("#slider-2").fadeOut(400);
            $("#slider-1").delay(400).fadeIn(400);
            $("#sButton2").removeClass("bg-purple-800");
            $("#sButton1").addClass("bg-purple-800");
            reinitLoop(4000);
            cont=0

        }

        function sliderButton2(){
            $("#slider-1").fadeOut(400);
            $("#slider-2").delay(400).fadeIn(400);
            $("#sButton1").removeClass("bg-purple-800");
            $("#sButton2").addClass("bg-purple-800");
            reinitLoop(4000);
            cont=1

        }

        $(window).ready(function(){
            $("#slider-2").hide();
            $("#sButton1").addClass("bg-purple-800");


            loopSlider();
        });


    </script>
</x-app-layout>
