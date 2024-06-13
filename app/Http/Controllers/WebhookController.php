<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\WebhookSignature;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('stripe.webhook_secret');

        try {
            $event = WebhookSignature::verifyHeader($payload, $sigHeader, $secret, 300);

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    break;
                default:
                    return response()->json(['status' => 'Unhandled event type'], 400);
            }

            return response()->json(['status' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Error'], 400);
        }
    }
}
