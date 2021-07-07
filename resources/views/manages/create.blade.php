<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Beverage
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('manage.store') }}" enctype="multipart/form-data">
        @csrf


        <div class="my-5 bg-white shadow overflow-hidden sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors class="mb-4 mt-2" :errors="$errors" />
            <x-success-message class="mt-2"></x-success-message>
            <ul class="divide-y divide-gray-200">
                <li class="py-4">
                    <div>
                        <div class="flex justify-between">
                            <label for="name" class="block text-sm font-medium text-gray-700">Beverage Name</label>
                            <span class="text-sm text-gray-500" id="email-optional">Required</span>
                        </div>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-400 focus:border-indigo-400 block w-full sm:text-sm border-gray-300 rounded-md" aria-describedby="name-required" :value="old('name')">
                        </div>
                    </div>
                </li>

                <li class="py-4">
                    <div>
                        <div class="flex justify-between">
                            <label for="price" class="block text-sm font-medium text-gray-700">Beverage Price</label>
                            <span class="text-sm text-gray-500" id="email-optional">Required</span>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm">
                                    Rp.
                                  </span>
                            </div>
                            <input type="number" name="price" id="price" class="focus:ring-indigo-400 focus:border-indigo-400 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm" id="price-currency">
                                    IDR
                                  </span>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="py-4">
                    <div>
                        <div class="flex justify-between">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Beverage Stock</label>
                            <span class="text-sm text-gray-500" id="email-optional">Required</span>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" min="1" name="stock" id="stock" class="focus:ring-indigo-400 focus:border-indigo-400 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm" id="price-currency">
                                    QTY
                                  </span>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="py-4">
                    <div>
                        <div class="flex justify-between">
                            <label for="type" class="block text-sm font-medium text-gray-700">Beverage Type</label>
                            <span class="text-sm text-gray-500" id="email-optional">Required</span>
                        </div>
                        <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-400 focus:border-indigo-400 sm:text-sm rounded-md">
                            @foreach($types as $type)
                                <option value={{$type->id}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

                <li class="py-4">
                    <fieldset>
                        <div class="flex justify-between">
                            <label for="type" class="block text-sm font-medium text-gray-700">Adds On</label>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="sugar" name="sugar" type="checkbox" class="checked:bg-green-600 h-4 w-4 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="sugar" class="font-medium text-gray-700">Custom Sugar</label>
                                    <p class="text-gray-500">Allow customer to customize sugar level.</p>
                                </div>
                            </div>
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="ice" name="ice" type="checkbox" class="checked:bg-green-600 h-4 w-4 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="ice" class="font-medium text-gray-700">Ice</label>
                                    <p class="text-gray-500">Allow customer to customize ice level.</p>
                                </div>
                            </div>
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="topping" name="topping" type="checkbox" class="appearance-none checked:bg-green-600 checked:border-transparent h-4 w-4 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Topping</label>
                                    <p class="text-gray-500">Allow customer to choose topping.</p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </li>

                <li class="py-4">
                    <div>
                        <div class="flex justify-between">
                            <label for="image" class="block text-sm font-medium text-gray-700">Beverage Image</label>
                            <span class="text-sm text-gray-500" id="email-optional">Required</span>
                        </div>
                        <div class="mb-2">
                            <div class="mt-1 relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                <div class="absolute">
                                    <div class="flex flex-col items-center ">
                                        <i class="fa fa-cloud-upload fa-3x text-gray-200" id="fontawesome"></i>
                                        <img class="w-20" src="" alt="" id="photo-preview">
                                        <span class="block text-blue-400 font-normal">Browse files</span>
                                    </div>
                                </div>
                                <input type="file" class="h-full w-full opacity-0" name="image" id="image">
                            </div>
                            <div class="flex justify-between items-center text-gray-400"> <span class="block font-medium text-sm text-gray-400">Accepted file image only</span></div>
                        </div>
                    </div>
                </li>

                <div class="py-4">
                    <input type="submit" class="mx-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"/>
                </div>

                <script type="text/javascript">
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#fontawesome').hide();
                                $('#photo-preview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $("#image").change(function(){
                        readURL(this);
                    });
                </script>

            </ul>
        </div>
    </form>

</x-app-layout>
