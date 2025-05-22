<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
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
            $response = $this->client->request('GET', $this->baseUrl . '/user');
            $users = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.users.index', compact('users'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string|min:6|max:50',
            'level' => 'required|string|max:50',
        ]);

        try {
            $this->client->request('POST', $this->baseUrl . '/user', [
                'json' => $request->only(['username', 'password', 'level'])
            ]);
            
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to add data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . '/user/' . $id);
            $user = json_decode($response->getBody()->getContents(), true);
            
            return view('admin.users.edit', compact('user'));
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'level' => 'required|string|max:50',
        ]);

        $userData = $request->only(['username', 'level']);
        
        // Only include password if it's provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6|max:50',
            ]);
            $userData['password'] = $request->password;
        }

        try {
            $this->client->request('PUT', $this->baseUrl . '/user/' . $id, [
                'json' => $userData
            ]);
            
            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to update data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->request('DELETE', $this->baseUrl . '/user/' . $id);
            
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to delete data: ' . $e->getMessage());
        }
    }
}
