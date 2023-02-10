<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List of Employees
        </h2>
    </x-slot>

    @if ($message = Session::get('success'))
        <x-alert type="success" title="Success!" :message="$message" />
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-10 lg:px-10">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"> 
                        Create New Employee</a>
                </div>

                <table class="min-w-full table-auto">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Picture</th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Name</th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Actions</th>
                    </tr>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <img src="{{ asset('images/' . $employee->picture) }}"  class="w-10 h-10 rounded-full" />
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $employee->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <form onsubmit="return confirm('Confirm delete this employee?');" action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                                    <div class="flex flex-nowrap">
                                    <a href="{{ route('employees.show', [$employee->id, 'page'=>$employees->currentPage()]) }}">
                                        <x-action-icon name="eye" color="blue" />
                                    </a>

                                    <a href="{{ route('employees.edit', [$employee->id, 'page'=>$employees->currentPage()]) }}">
                                        <x-action-icon name="pencil-alt" color="green" />
                                    </a>

                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="page" value="{{ $employees->currentPage() }}" />
                                    <button type="submit" class="btn btn-danger">
                                        <x-action-icon name="trash" color="red" />
                                    </button>
                                </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
            {!! $employees->links() !!}
        </div>
    </div>

    

</x-app-layout>
