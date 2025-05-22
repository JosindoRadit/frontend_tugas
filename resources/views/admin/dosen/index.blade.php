@extends('layouts.admin')

@section('title', 'Daftar Dosen')

@section('header', 'Daftar Dosen')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-800">Daftar Dosen</h2>
    <a href="{{ route('dosen.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-plus mr-1"></i> Tambah Dosen
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prodi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($dosen) && is_array($dosen) && count($dosen) > 0)
                    @foreach($dosen as $d)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d['id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $d['nama'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d['nidn'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d['prodi'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('dosen.edit', $d['id']) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('dosen.destroy', $d['id_user']) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dosen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data dosen</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
