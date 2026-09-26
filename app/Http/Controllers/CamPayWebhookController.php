<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\CampayWebhookLog;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CamPayWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        CampayWebhookLog::create([
            'campay_reference' => $data['reference'] ?? null,
            'payload' => $data,
            'status_received' => $data['status'] ?? null,
        ]);

        $signature = $data['signature'] ?? null;

        if (!$signature) {
            return response()->json(['message' => 'signature manquante'], 401);
        }

        try {
            JWT::decode($signature, new Key(config('services.campay.webhook_key'), 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'signature invalide'], 401);
        }

        $payment = Payment::where('campay_reference', $data['reference'] ?? null)->first();

        if ($payment) {
            $payment->update([
                'status' => strtoupper($data['status'] ?? '') === 'SUCCESSFUL' ? 'success' : 'failed',
                'payment_method' => isset($data['operator']) ? strtolower($data['operator']) : $payment->payment_method,
            ]);
        }

        return response()->json(['message' => 'ok']);
    }
}