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
                
                <form action="{{ route('admin.project.assign.tool.store', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-col gap-y-5">
                        <h1 class="text-3xl text-indigo-950 font-bold">
                            Assign Tool
                        </h1>

                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{Storage::url($project->cover)}}" class="object-cover w-[120px] h-[90px] rounded-2xl">
                            <div class="flex flex-col gap-y-1">
                                <h3 class="font-bold text-xl">{{ $project->name }}</h3>
                                <p class="text-sm text-slate-400">{{ $project->category }}</p>
                            </div>
                        </div>
    
                        <div class="flex flex-col gap-y-2">
                            <h3>
                                Tools
                            </h3>
                            <select name="tool_id" id="tool_id">
                                <option value="">Choose tool below</option>
                                @forelse ($tools as $tool)
                                    <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                @empty
                                  
                                @endforelse
                                
                            
                            </select>
                        </div>
                       
                        <button type="submit" class="py-4 w-full rounded-full bg-violet-700 hover:bg-violet-900 font-bold text-white">Assign Tool</button>
                    </div>

                </form>

                <hr class="my-10">
                
                <h3 class="text-xl text-indigo-950 font-bold mb-5">
                    Existing Tools
                </h3>

                <div class="flex flex-col gap-y-5">

                    @forelse ($project->tools as $tool)
                    <div class="item-project flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{Storage::url($tool->logo)}}" class="object-cover w-[120px] h-[90px] rounded-2xl">
                            <div class="flex flex-col gap-y-1">
                                <h3 class="font-bold text-xl">{{ $tool->name }}</h3>
                                <p class="text-sm text-slate-400">{{ $tool->tagline }}</p>
                            </div>
                        </div>


                        <div class="flex flex-row items-center gap-x-2">
                            <a href="{{ route('admin.tools.edit', $tool) }}" class="py-3 px-5 rounded-full bg-indigo-500 text-white">
                                Edit
                            </a>
                            <form action="{{ route('admin.project_tools.destroy', $tool->pivot->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="py-3 px-5 rounded-full bg-red-500 text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                        
                    </div>
                    @empty

                    <p>Belum ada tool tersedia.</p>

                    @endforelse

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
