<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DashboardController extends Controller
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
            
            $userCount = is_array($users) ? count($users) : 0;
            
            // Count users by level
            $usersByLevel = [];
            if (is_array($users)) {
                foreach ($users as $user) {
                    $level = $user['level'] ?? 'unknown';
                    if (!isset($usersByLevel[$level])) {
                        $usersByLevel[$level] = 0;
                    }
                    $usersByLevel[$level]++;
                }
            }
            
            return view('admin.dashboard', compact('userCount', 'usersByLevel'));
        } catch (RequestException $e) {
            return view('admin.dashboard')->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }
}
