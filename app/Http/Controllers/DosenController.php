<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DosenController extends Controller
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
            $response = $this->client->request('GET', $this->baseUrl . '/dosen');
            $dosen = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.dosen.index', compact('dosen'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nidn' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'prodi' => 'required|string|max:100',
        ]);

        try {
            $this->client->request('POST', $this->baseUrl . '/dosen', [
                'json' => $request->only(['nama', 'nidn', 'email', 'prodi'])
            ]);
            
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to add data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/dosen/' . $id);
            $dosen = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.dosen.edit', compact('dosen'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nidn' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'prodi' => 'required|string|max:100',
        ]);

        try {
            $this->client->request('PUT', $this->baseUrl . '/dosen/' . $id, [
                'json' => $request->only(['nama', 'nidn', 'email', 'prodi'])
            ]);
            
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to update data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->request('DELETE', $this->baseUrl . '/dosen/' . $id);
            
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to delete data: ' . $e->getMessage());
        }
    }
}
