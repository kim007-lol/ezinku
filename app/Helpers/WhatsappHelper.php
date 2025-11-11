<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
   public static function send($to, $message)
{
    if (setting('whatsapp_enabled') != '1') {
        Log::info('📴 WhatsApp notifikasi dimatikan oleh admin.');
        return;
    }

    $url = setting('whatsapp_api_url');
    $token = setting('whatsapp_token');

    Log::info('📤 Kirim WA', [
    'url' => $url,
    'full_request' => [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ],
        'payload' => [
            'target' => $formattedNumber,
            'message' => $message,
            'delay' => 0
        ],
    ],
]);


    // Format nomor telepon: pastikan dimulai dengan 62
    $formattedNumber = preg_replace('/^0/', '62', $to);
    if (!str_starts_with($formattedNumber, '62')) {
        $formattedNumber = '62' . $formattedNumber;
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
    ])->post($url, [
        'target' => $formattedNumber,
        'message' => $message,
        'delay' => 0
    ]);

    if (!$response->successful()) {
        Log::error('❌ Gagal kirim WA', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
    } else {
        Log::info('✅ WA sukses terkirim', [
            'body' => $response->body(),
        ]);
    }

    return $response->json();
}
}