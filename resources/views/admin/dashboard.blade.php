@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5 bg-purple-500 text-white">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium truncate">
                            Total Users
                        </dt>
                        <dd>
                            <div class="text-lg font-medium">
                                {{ $userCount ?? 0 }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('users.index') }}" class="font-medium text-purple-600 hover:text-purple-900">
                    View all users
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5 bg-indigo-500 text-white">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-shield text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium truncate">
                            User Management
                        </dt>
                        <dd>
                            <div class="text-lg font-medium">
                                System
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('users.create') }}" class="font-medium text-indigo-600 hover:text-indigo-900">
                    Add new user
                </a>
            </div>
        </div>
    </div>
</div>

@if(isset($usersByLevel) && count($usersByLevel) > 0)
<div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Users by Level
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Distribution of users by access level.
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            @foreach($usersByLevel as $level => $count)
            <div class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    {{ ucfirst($level) }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $count }} users
                </dd>
            </div>
            @endforeach
        </dl>
    </div>
</div>
@endif

<div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            System Information
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Details about the admin panel.
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Application Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    User Management Dashboard
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    API Endpoint
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    http://localhost:8080
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Framework
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Laravel + Blade
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection
