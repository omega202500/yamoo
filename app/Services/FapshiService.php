<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class FapshiService
{
    protected string $baseUrl;
    protected array $headers;

    public function __construct()
    {
        $this->baseUrl = config('services.fapshi.base_url');
        $this->headers = [
            'apiuser' => config('services.fapshi.api_user'),
            'apikey'  => config('services.fapshi.api_key'),
        ];
    }

    public function initiatePay(int $amount, string $externalId, ?string $phone = null): array
    {
        $payload = [
            'amount' => $amount,
            'externalId' => $externalId,
            'redirectUrl' => route('access.confirmation'),
            'message' => 'Acces Yamoo',
        ];

        if ($phone) {
            $payload['phone'] = $phone;
        }

        $response = Http::withHeaders($this->headers)
            ->post("{$this->baseUrl}/initiate-pay", $payload);

        return $response->json(); // ['link' => ..., 'transId' => ..., 'dateInitiated' => ...]
    }

    public function checkStatus(string $transId): array
    {
        return Http::withHeaders($this->headers)
            ->get("{$this->baseUrl}/payment-status/{$transId}")
            ->json(); // status: CREATED, PENDING, SUCCESSFUL, FAILED, EXPIRED
    }
}