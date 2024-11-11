<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="py-5 bg-red-700 text-white font-bold">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                @endif
                
                <form action="{{ route('admin.tools.update', $tool) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-y-5">
                        <h1 class="text-3xl text-indigo-950 font-bold">
                            Edit Tool
                        </h1>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Name
                            </h3>
                            <input type="text" value="{{ $tool->name }}" id="name" name="name">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Tagline
                            </h3>
                            <input type="text" value="{{ $tool->tagline }}" id="tagline" name="tagline">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Logo
                            </h3>
                            <img src="{{Storage::url($tool->logo)}}" class="object-cover w-[120px] h-[90px] rounded-2xl">
                            <input type="file" id="logo" name="logo" accept="image/*">
                        </div>
                    
                        <button type="submit" class="py-4 w-full rounded-full bg-violet-700 hover:bg-violet-900 font-bold text-white">Update Tool</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
