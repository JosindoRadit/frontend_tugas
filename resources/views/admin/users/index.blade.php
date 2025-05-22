@extends('layouts.admin')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-800">User List</h2>
    <a href="{{ route('users.create') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-plus mr-1"></i> Add User
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($users) && is_array($users) && count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user['id_user'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user['username'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user['level'] == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                       ($user['level'] == 'superadmin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $user['level'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('users.edit', $user['id_user']) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user['id_user']) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No users found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
