<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TestWAController extends Controller
{
    public function test()
    {
        try {
            $url = 'https://api.fonnte.com/send';
            $token = 'stK9KwkVn9Ca4U7t9syi';
            $target = '6283878224356'; // Format: 62 + nomor tanpa 0 di depan
            
            // Debug log sebelum request
            \Log::info('🚀 Memulai pengiriman WA', [
                'url' => $url,
                'target' => $target,
                'token_length' => strlen($token),
                'timestamp' => now()->toDateTimeString()
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'target' => $target,
                'message' => '🔔 Test Notifikasi E-Izin via Fonnte - ' . now()->toDateTimeString(),
                'delay' => 0
            ]);
            
            // Log response
            \Log::info('📥 Response dari Fonnte:', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            return response()->json([
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

        } catch (\Exception $e) {
            \Log::error('❌ Error saat kirim WA:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

    return response()->json([
        'status' => $response->status(),
        'response' => $response->json(),
    ]);
}
}