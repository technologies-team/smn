<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Tests\Thing1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Ignition\Tests\TestClasses\Models\Car;

class CartsService extends ModelService
{
    protected UserService $userService;
    protected KitchenService $kitchenService;
    protected FoodService $foodService;
    protected CartsItemService  $cartsItemService;

    public function __construct(UserService $userService, KitchenService $kitchenService, FoodService $foodService,CartsItemService  $cartsItemService)
    {
        $this->userService = $userService;
        $this->kitchenService = $kitchenService;
        $this->foodService = $foodService;
        $this->cartsItemService = $cartsItemService;
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
    protected array $updatables = ['tax',
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
        $user = $this->getUser();
        if ($user instanceof User) {
            $cart = $user->carts()->first();
            if ($cart instanceof Cart) {
                return $cart;
            } else {
                $attributes["user_id"] = $user->id;
                // $cart = $this->cartsService->store($attributes);
                if ($cart instanceof Cart) {
                    return $cart;
                }
            }
        }
        throw new Exception("there is user error");
    }

    /**
     * @throws Exception
     */
    public function addToCart(array $attributes): Result
    {
        $user = $this->getUser();
        $attributes['user_id'] = $user->id;
        foreach ($attributes['foods'] as $foodCart) {

            $food=$this->foodService->find($foodCart['food_id']);
            $kitchen_id=$food->kitchen_id;
           $cart= $this->getCartBy("kitchen_id",$kitchen_id,$user->id);
           if($cart instanceof Cart){

           }
           else{
               $newCart=[
                   'user_id'=>$user->id,
                   'kitchen_id'=>$kitchen_id
               ];
              $cart= $this->create($newCart);
           }
            $foodCart["cart_id"]=$cart->id;
         $item=  $this->cartsItemService->store($foodCart);
dd($item);
        }

        return $this->ok($attributes, "added to cart");
    }

    /**
     * @throws Exception
     */
    protected function getUser(): Model
    {
        $user_id = auth()->user()->getAuthIdentifier();

        return $this->userService->find($user_id);
    }

    private function getCartBy(string $field, int $kitchen_id, $user_id)
    {
        return Cart::query()
            ->where($field, '=', $kitchen_id)
            ->where('user_id', $user_id)
            ->first();
    }
}
