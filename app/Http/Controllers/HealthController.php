<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class HealthController extends Controller
{
    /**
     * Basic health check endpoint
     */
    public function check()
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toISOString(),
            'app_name' => config('app.name'),
            'app_env' => config('app.env'),
        ]);
    }

    /**
     * Detailed health check with dependencies
     */
    public function detailed()
    {
        $checks = [
            'app_key' => $this->checkAppKey(),
            'database' => $this->checkDatabase(),
            'storage' => $this->checkStorage(),
        ];

        $overall = collect($checks)->every(fn($check) => $check['status'] === 'ok');

        return response()->json([
            'status' => $overall ? 'ok' : 'error',
            'timestamp' => now()->toISOString(),
            'checks' => $checks,
        ], $overall ? 200 : 503);
    }

    private function checkAppKey()
    {
        $key = config('app.key');
        
        if (empty($key)) {
            return ['status' => 'error', 'message' => 'APP_KEY is not set'];
        }
        
        if (strlen($key) < 20) {
            return ['status' => 'error', 'message' => 'APP_KEY is too short'];
        }
        
        if ($key === 'base64:YourGeneratedKeyWillBeHere') {
            return ['status' => 'error', 'message' => 'APP_KEY is placeholder value'];
        }
        
        return ['status' => 'ok', 'message' => 'APP_KEY is valid'];
    }

    private function checkDatabase()
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'ok', 'message' => 'Database connection successful'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()];
        }
    }

    private function checkStorage()
    {
        $storagePath = storage_path('app');
        
        if (!is_writable($storagePath)) {
            return ['status' => 'error', 'message' => 'Storage directory is not writable'];
        }
        
        return ['status' => 'ok', 'message' => 'Storage is writable'];
    }
}
