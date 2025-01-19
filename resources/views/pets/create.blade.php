@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a New Pet</h2>
            <form method="POST" action="{{ route('pets.store') }}">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 pb-4 sm:gap-6">
                    <!-- Name Field -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter pet name" required value="{{ old('name') }}">
                        @error('name')
                        <div class="text-red-600 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="w-full">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="available" selected>Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                        </select>
                        @error('status')
                        <div class="text-red-600 text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="bg-green-700 hover:bg-green-300 text-white  hover:text-gray-800 font-bold py-2 px-4 rounded inline-block">
                    Add Pet
                </button>
            </form>
        </div>
    </section>

@endsection
