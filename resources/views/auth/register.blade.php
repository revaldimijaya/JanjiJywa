<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="5 - 30 Character" />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="E.g. example@example.com" />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="5 - 30 Character Alpha Numeric"/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required
                                />
            </div>

            <div class="mt-4">
                <x-label for="gender-radio" :value="__('Gender')"></x-label>
                <x-label class="mt-1 inline-flex items-center">
                    <input type="radio" class="gender-radio" name="gender" value="Male" id="male" checked>
                    <span class="ml-2" >Male</span>
                </x-label>
                <x-label class="mt-1 inline-flex items-center ml-6">
                    <input type="radio" class="gender-radio" name="gender" value="Female" id="female">
                    <span class="ml-2">Female</span>
                </x-label>
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')"></x-label>
                <textarea :value="old('address')" id="address" name="address" class="mt-1 form-textarea block w-full" rows="3" placeholder="E.g. Jl. Raya Kb. Jeruk No.27, RT.2/RW.9, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530"></textarea>
            </div>

            <div class="mt-4">
                <div class="mb-2">
                    <x-label>Profile Photo</x-label>
                    <div class="mt-1 relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                        <div class="absolute">
                            <div class="flex flex-col items-center ">
                                <i class="fa fa-cloud-upload fa-3x text-gray-200" id="fontawesome"></i>
                                <img class="w-1/4" src="" alt="" id="photo-preview">
                                <span class="block text-blue-400 font-normal">Browse files</span>
                            </div>
                        </div>
                        <input type="file" class="h-full w-full opacity-0" name="image" id="image">
                    </div>
                    <div class="flex justify-between items-center text-gray-400"> <span class="block font-medium text-sm text-gray-400">Accepted file image only</span></div>
                </div>
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

            <div class="mt-4">
                <x-label for="role" :value="__('Role')"></x-label>
                <select class="mt-1 form-select block w-full mt-1" name="role" id="role">
                    @foreach($roles as $role)
                        @if($role->name != "CEO")
                            <option value={{$role->id}}>{{$role->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
