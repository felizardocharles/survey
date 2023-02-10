<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-10 lg:px-10">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    href="{{ route('employees.index', ['page' => $page]) }}"> Back</a>
                </div>

                <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                            Name:
                        </label>
                        <input type="text" disabled class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ $employee->name }}" />
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="picture">
                            Picture:
                        </label>
                        <img src="{{ asset('images/' .  $employee->picture) }}" width="200" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>