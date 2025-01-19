@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">List of Pets</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 border border-green-400 rounded p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-700 border border-red-400 rounded p-4 mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pets as $pet)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $pet['id'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $pet['name'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 capitalize">{{ $pet['status'] }}</td>
                            <td class="border border-gray-300 py-2 text-center">
                                <a href="{{ route('pets.edit', $pet['id']) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-block">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('pets.destroy', $pet['id']) }}" onsubmit="return confirm('Are you sure you want to delete this pet?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pets->links('pagination::tailwind') }}
            </div>
    </div>
@endsection
