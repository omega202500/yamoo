<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\FapshiService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('access.index', [
            'amount' => config('services.access_amount'),
        ]);
    }

    public function pay(Request $request, FapshiService $fapshi)
    {
        $request->validate(['phone' => 'required|string']);

        $phone = preg_replace('/\D/', '', $request->phone);
        if (strlen($phone) === 9) {
            $phone = '237' . $phone;
        }

        $amount = config('services.access_amount');

        $payment = Payment::create([
            'phone' => $phone,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        $result = $fapshi->initiatePay($amount, (string) $payment->id, $phone);

        if (!isset($result['link'])) {
            $payment->update(['status' => 'failed']);
            return back()->withErrors(['phone' => $result['message'] ?? 'Erreur lors de l’initiation du paiement.']);
        }

        session(['last_fapshi_trans_id' => $result['transId']]);
        $payment->update(['campay_reference' => $result['transId']]);

        return redirect()->away($result['link']);
    }

    public function confirmation(Request $request, FapshiService $fapshi)
    {
        $reference = $request->query('reference') ?? session('last_fapshi_trans_id');

        $payment = $reference
            ? Payment::where('campay_reference', $reference)->first()
            : null;

        if ($payment && $payment->status === 'pending') {
            $status = $fapshi->checkStatus($payment->campay_reference);
            $fapshiStatus = strtoupper($status['status'] ?? '');

            $payment->update([
                'status' => match ($fapshiStatus) {
                    'SUCCESSFUL' => 'success',
                    'FAILED' => 'failed',
                    default => 'pending',
                },
                'payment_method' => isset($status['operator'])
                    ? strtolower($status['operator'])
                    : $payment->payment_method,
            ]);
        }

        return view('access.confirmation', [
            'payment' => $payment,
            'whatsappLink' => $payment && $payment->status === 'success'
                ? config('services.whatsapp_group_link')
                : null,
        ]);
    }
}
