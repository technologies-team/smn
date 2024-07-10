<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Tests\Thing1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CartsService extends ModelService
{
    protected UserService $userService;
    public function __construct(UserService $userService){
       $this->userService=$userService;

    }
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

    /**
     * @throws Exception
     */
    public function getUserCart($kitchen_id): Cart
    {
        $user_id = auth()->user()->getAuthIdentifier();

        $user = $this->userService->find($user_id);
        if ($user instanceof User) {
            $cart = $user->carts()->first();
            if ($cart instanceof Cart) {
                return $cart;
            } else {
                $attributes["user_id"] = $user_id;
               // $cart = $this->cartsService->store($attributes);
                if ($cart instanceof Cart) {
                    return $cart;
                }
            }
        }
        throw new Exception("there is user error");
    }
}
