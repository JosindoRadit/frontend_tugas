@extends('layouts.admin')

@section('title', 'Edit Dosen')

@section('header', 'Edit Dosen')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
    <form action="{{ route('dosen.update', $dosen['id_user']) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen['nama']) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('nama') border-red-500 @enderror" required>
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="nidn" class="block text-sm font-medium text-gray-700">NIDN</label>
            <input type="text" name="nidn" id="nidn" value="{{ old('nidn', $dosen['nidn']) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('nidn') border-red-500 @enderror" required>
            @error('nidn')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $dosen['email']) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
            <input type="text" name="prodi" id="prodi" value="{{ old('prodi', $dosen['prodi']) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('prodi') border-red-500 @enderror" required>
            @error('prodi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('dosen.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
