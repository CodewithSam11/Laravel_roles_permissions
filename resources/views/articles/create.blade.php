<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles / Create
            </h2>
            <a href="{{ route('articles.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('articles.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="title" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input type="text" name="title" id="title" value="{{old('title')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter title">
                                @error('title')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Content</label>
                            <div class="my-3">
                                <textarea name="text" id="text" cols="30" rows="10" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Content">{{old('text')}}</textarea>

                            </div>
                            <label for="author" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                                <input type="text" name="author" id="author" value="{{old('author')}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter author">
                                @error('author')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
