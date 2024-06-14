<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\DTOs\Result;
use App\Models\StripePayment;
use App\Services\StripePaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Stripe\Webhook;

class PaymentController extends Controller
{
    protected StripeClient $stripe;
    protected StripePaymentService $stripePayment;

    public function __construct(StripePaymentService $stripePayment)
    {
        $this->stripe = new StripeClient(config('stripe.secret'));
        $this->stripePayment=$stripePayment;
    }

    public function createPaymentIntent(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
            'currency' => 'required|string',
        ]);
        $amount= $request->amount;
        $currencty=$request->currency;
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => $currencty,
                'payment_method_types' => ['card'],
            ]);
            $data=[
                'clientSecret' => $paymentIntent->client_secret,
                'id' => $paymentIntent->id,
                'amount' => $amount,
                'currency' => $currencty,

            ];
            $this->stripePayment->create($data);
           return$this->ok(new Result($data,'payment intent success'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request): JsonResponse
    {
        $payload = @file_get_contents('php://input');
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                Log::channel('payment')->info('PaymentIntent was created', ['payment_intent' => $event->id,'amount'=>$paymentIntent->amount]);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $id= $paymentIntent->id;
                $record=  $this->stripePayment->findBy("payment_id",$id);
                if($record instanceof StripePayment){
                    $this->stripePayment->save($record->id,[]);
                }
                Log::channel('payment')->info('PaymentIntent was successful!', ['payment_intent' =>$id,'amount'=>$paymentIntent->data->object->amount]);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                Log::channel('payment')->error('PaymentIntent failed', ['payment_intent' => $paymentIntent]);
                break;
            default:
                Log::channel('payment')->warning('Unhandled event type', ['event' => $event]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function savePaymentIntent(array $data,$currency,$amount)
    {
        $user_id=auth()->id();
        $stripePayment = StripePayment::create([
            'payment_id' => $data["id"],
            'user_id' =>  $user_id,
            'amount' => $amount,
            'currency' => $currency,
            'status' =>"created",
            'description' => "smn food",
            'payment_date' => now(),
        ]);
    }
}
