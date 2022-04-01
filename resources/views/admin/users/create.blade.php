<x-guest-layout>
    <x-auth-card>
        {{-- <img src="/images/logotipo.png" alt="logotipo"/> --}}
            <x-slot name="logo">
                <h1>Create new User</h1>
            </x-slot>
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
    
                <!-- Name -->
                <div>
                    <br>
                    <x-label for="name" :value="__('Name')" />
    
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
    
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>
                <div class="mt-4">
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" name="roles[]"
                            type="checkbox" value="{{$role->id}}}" id="{{$role->name}}">
                            <label class="form-check-label" for="{{$role->name}}">
                                {{$role->name}}
                            </label> 
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
    </x-auth-card>
</x-guest-layout>
    