<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
use App\Models\Offer;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Tests\Thing1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CartsItemService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'session_id',
        'user_id',
        'kitchen_id',
        'tax',
        'total_tax',
        'price',
        'total_price',
        'discount',
        'total_discount',
        'rewards',
        'total_rewards',
        'coupon_id',
        'offer_id',
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [ 'tax',
        'total_tax',
        'price',
        'total_price',
        'discount',
        'total_discount',
        'rewards',
        'total_rewards',
        'coupon_id',
        'offer_id',];
/**
 * *
**/
    protected array $with = [];

    public function builder(): Builder
    {
        return Cart::query();
    }
        public function getUserCart(): Cart
    {
        $user_id = auth()->user()->getAuthIdentifier();

        $user = $this->userService->find($user_id);
        if ($user instanceof User) {
            $cart = $user->carts()->first();
            if ($cart instanceof Cart) {
                return $cart;
            } else {
                $attributes["user_id"] = $user_id;
                $cart = $this->cartsService->store($attributes);
                if ($cart instanceof Cart) {
                    return $cart;
                }
            }
        }
        throw new Exception("there is user error");
    }

    public function calcDiscount($price, $type, $value, $max)
    {
        return match ($type) {
            "percent_limited", "percent" => $max > 0 ? min((($price * $value) / 100), $max) : ($price * $value) / 100,
            "fixed" => min($value, $price),
            default => 0,
        };
    }


    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }

    private function applayOffere(mixed $offer_id, $service, $price): int
    {
        $offer = $service->offers()->find($offer_id);
        if ($offer instanceof Offer) {
            if (isset($offer->min_amount) && $offer->min_amount > $price) {
                return 0;
            }
            return $this->calcDiscount($price, $offer->type, $offer->value, $offer->percent_limited);
        }
        return 0;
    }
}
