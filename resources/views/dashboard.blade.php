<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome ' . Auth::user()->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __('Your Prize Bonds') }}
                </div>
                <div>
                    <button type="button" class="btn btn-light mr-5 font-bold" data-bs-toggle="modal" data-bs-target="#createBond"><i
                            class="fa-solid fa-plus mr-2"></i>Add New Bond</button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="flex items-center justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold w-full">
                    <table id="bondsTable" class="table w-full">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Amount</th>
                                <th>Prefix</th>
                                <th>Serial Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($bonds as $prefix => $groupedBonds)
                                @foreach ($groupedBonds as $bond)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $bond->amount }}</td>
                                        <td>{{ $bond->prefix }}</td>
                                        <td>{{ $bond->serial }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editBond" data-id="{{ $bond->id }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                            <a href="{{ route('prize-bond.destroy', $bond->id) }}" class="delete-data">
                                                <button type="button" class="btn btn-outline-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- Modal -->
        @include('create')
        @include('edit')
    </div>
</x-app-layout>
