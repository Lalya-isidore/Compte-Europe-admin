<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

class TwilioService
{
    private ?Client $client = null;
    private string $from = '';

    public function __construct()
    {
        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $from = config('services.twilio.whatsapp_from');

        $this->from = (string) $from;
        if ($accountSid && $authToken) {
            $this->client = new Client($accountSid, $authToken);
        }
    }

    public function sendWhatsAppMessage(string $to, string $message): void
    {
        if (! $this->client || ! $this->from || ! $to) {
            return;
        }

        $toNumber = $this->formatWhatsAppNumber($to);

        try {
            $this->client->messages->create($toNumber, [
                'from' => $this->formatWhatsAppNumber($this->from),
                'body' => $message,
            ]);
        } catch (RestException $exception) {
            Log::warning('Twilio WhatsApp API error', [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);
        } catch (\Throwable $exception) {
            Log::warning('Unexpected error when sending WhatsApp message', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    private function formatWhatsAppNumber(string $raw): string
    {
        $normalized = preg_replace('/[^0-9+]/', '', $raw) ?: '';

        if (! str_starts_with($normalized, '+')) {
            $normalized = '+' . ltrim($normalized, '+');
        }

        if (! str_starts_with($normalized, 'whatsapp:')) {
            $normalized = 'whatsapp:' . $normalized;
        }

        return $normalized;
    }
}
