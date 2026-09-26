<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CamPayService
{
    protected string $baseUrl;
    protected string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.campay.base_url');
        $this->token = config('services.campay.token');
    }

    public function getPaymentLink(int $amount, string $externalReference, ?string $phone = null): array
    {
        $payload = [
            'amount' => (string) $amount,
            'currency' => 'XAF',
            'description' => 'Acces Yamoo',
            'external_reference' => $externalReference,
            'redirect_url' => route('access.confirmation'),
            'failure_redirect_url' => route('access.confirmation'), // même page
            'payment_options' => 'MOMO,CARD',
        ];

        if ($phone) {
            $payload['from'] = $phone;
        }

        $response = Http::withToken($this->token, 'Token')
            ->post("{$this->baseUrl}/get_payment_link/", $payload);

        return $response->json();
    }

    public function checkStatus(string $reference): array
    {
        return Http::withToken($this->token, 'Token')
            ->get("{$this->baseUrl}/transaction/{$reference}/")
            ->json();
    }
}