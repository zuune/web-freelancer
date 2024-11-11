<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                
                <div class="flex flex-col gap-y-5">
                    <h1 class="text-3xl text-indigo-950 font-bold">
                        Order Detail
                    </h1>

                    <div class="flex flex-row items-center gap-x-5">
                        <div class="flex flex-col gap-y-1">
                            <h3 class="font-bold text-xl">{{ $order->name }}</h3>
                            <p class="text-sm text-slate-400">{{ $order->category }}</p>
                        </div>
                    </div>

                   
                </div>

                <hr class="my-10">
                
                <h3 class="text-xl text-indigo-950 font-bold mb-5">
                    Brief
                </h3>

                <p>
                    {{ $order->brief }}
                </p>

                <p>
                    {{ $order->email }}
                </p>

                <p>
                    {{ $order->budget }}
                </p>


        </div>
    </div>
</x-app-layout>
