<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MahasiswaController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8080';
    }

    public function index()
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/mahasiswa');
            $mahasiswa = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.mahasiswa.index', compact('mahasiswa'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'prodi' => 'required|string|max:100',
        ]);

        try {
            $this->client->request('POST', $this->baseUrl . '/mahasiswa', [
                'json' => $request->only(['nama', 'nim', 'email', 'prodi'])
            ]);
            
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to add data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/mahasiswa/' . $id);
            $mahasiswa = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.mahasiswa.edit', compact('mahasiswa'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'prodi' => 'required|string|max:100',
        ]);

        try {
            $this->client->request('PUT', $this->baseUrl . '/mahasiswa/' . $id, [
                'json' => $request->only(['nama', 'nim', 'email', 'prodi'])
            ]);
            
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to update data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->request('DELETE', $this->baseUrl . '/mahasiswa/' . $id);
            
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to delete data: ' . $e->getMessage());
        }
    }
}
