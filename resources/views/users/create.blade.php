<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users / Create
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input type="text" name="name" id="name" value="{{old('name')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter name">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="email" class="text-lg font-medium">Email</label>
                            <div class="my-3">
                                <input type="email" name="email" id="email" value="{{old('email')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter email">
                                @error('email')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="password" class="text-lg font-medium">Password</label>
                            <div class="my-3">
                                <input type="password" name="password" id="password" value="{{old('password')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter password">
                                @error('password')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                             <label for="confirm_password" class="text-lg font-medium">Confirm Password</label>
                            <div class="my-3">
                                <input type="password" name="confirm_password" id="confirm_password" value="{{old('confirm_password')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter confirm password">
                                @error('confirm_password')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                @if($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            {{-- {{$hasRoles->contains($role->id) ? 'checked' : ''}} --}}
                                            <input  type="checkbox" name="role[]" id="permission-{{$role->id}}" class="rounded cursor-pointer" value="{{$role->name}}">
                                            <label for="permission-{{$role->id}}">{{$role->name}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md hover:bg-slate-500 text-white px-5 py-3">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
