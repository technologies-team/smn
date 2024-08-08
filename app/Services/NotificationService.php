<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Notification;
use Carbon\Factory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Messaging;

use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;

use Lcobucci\JWT\UnencryptedToken;

class NotificationService extends UserService
{


    public function builder(): Builder
    {
        return Notification::query();
    }
    protected Auth $auth;
    protected Messaging $messagingApp1;
    protected Messaging $messagingApp2;

    public function __construct()
    {
        $firebaseAppCustomer = (new Factory)
            ->withServiceAccount(storage_path('app/key/customer.json'));

        $firebaseAppVendor = (new Factory)
            ->withServiceAccount(storage_path('app/key/vendor.json'));

        $this->auth = $firebaseAppCustomer->createAuth();
        $this->messagingApp1 = $firebaseAppCustomer->createMessaging();
        $this->messagingApp2 = $firebaseAppVendor->createMessaging();
    }

    public function verifyIdToken($idToken): ?UnencryptedToken
    {
        try {
            return $this->auth->verifyIdToken($idToken);
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function sendNotificationToAppCustomer(array $message): array
    {
        return $this->messagingApp1->send($message);
    }

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function sendNotificationToAppVendor(array $message): array
    {
        return $this->messagingApp2->send($message);
    }
}
