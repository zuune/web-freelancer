<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Projects') }}
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
                
                <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-y-5">
                        <h1 class="text-3xl text-indigo-950 font-bold">
                            Edit Project
                        </h1>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Name
                            </h3>
                            <input type="text" value="{{ $project->name }}" id="name" name="name">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Category
                            </h3>
                            <select name="category" id="category">
                                <option value="Website Development" @if($project->category === "Website Development") selected @endif>Website Development</option>
                                <option value="App Development" @if($project->category === "App Development") selected @endif>App Development</option>
                                <option value="Graphic Design" @if($project->category === "Graphic Design") selected @endif>Graphic Design</option>
                                <option value="Digital Marketing" @if($project->category === "Digital Marketing") selected @endif>Digital Marketing</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Cover Image
                            </h3>
                            <img src="{{Storage::url($project->cover)}}" class="object-cover w-[120px] h-[90px] rounded-2xl">
                            <input type="file" id="cover" name="cover" accept="image/*">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                About
                            </h3>
                            <textarea name="about" id="about" cols="30" rows="10">{{ $project->about }}</textarea>
                        </div>
                        <button type="submit" class="py-4 w-full rounded-full bg-violet-700 hover:bg-violet-900 font-bold text-white">Update Project</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
