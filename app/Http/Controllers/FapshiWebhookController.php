<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\CampayWebhookLog;
use App\Services\FapshiService;
use Illuminate\Http\Request;

class FapshiWebhookController extends Controller
{
    public function handle(Request $request, FapshiService $fapshi)
    {
        $data = $request->all();

        CampayWebhookLog::create([
            'campay_reference' => $data['transId'] ?? null,
            'payload' => $data,
            'status_received' => $data['status'] ?? null,
        ]);

        $transId = $data['transId'] ?? null;
        if (!$transId) {
            return response()->json(['message' => 'transId manquant'], 400);
        }

        // on ne fait jamais confiance au payload reçu — on revérifie auprès de Fapshi
        $status = $fapshi->checkStatus($transId);
        $fapshiStatus = strtoupper($status['status'] ?? '');

        $payment = Payment::where('campay_reference', $transId)->first();
        if ($payment) {
            $payment->update([
                'status' => match ($fapshiStatus) {
                    'SUCCESSFUL' => 'success',
                    'FAILED', 'EXPIRED' => 'failed',
                    default => 'pending',
                },
                'payment_method' => isset($status['medium']) ? strtolower($status['medium']) : $payment->payment_method,
            ]);
        }

        return response()->json(['message' => 'ok']);
    }
}