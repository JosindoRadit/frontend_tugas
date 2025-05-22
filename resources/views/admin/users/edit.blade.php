@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
    <form action="{{ route('users.update', $user['id_user']) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user['username']) }}" class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('username') border-red-500 @enderror" required>
            @error('username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
            <input type="password" name="password" id="password" class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="level" class="block text-sm font-medium text-gray-700">User Level</label>
            <select name="level" id="level" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm @error('level') border-red-500 @enderror" required>
                <option value="">Select Level</option>
                <option value="admin" {{ (old('level', $user['level']) == 'admin') ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ (old('level', $user['level']) == 'superadmin') ? 'selected' : '' }}>Super Admin</option>
                <option value="user" {{ (old('level', $user['level']) == 'user') ? 'selected' : '' }}>User</option>
            </select>
            @error('level')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
