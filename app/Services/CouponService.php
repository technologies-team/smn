<?php

namespace App\Services;

use App\DTOs\Result;
use App\Models\Coupon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Math\PrimeField\Integer;

class CouponService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = ['name', 'description', 'type', 'value', 'start_at', 'expires_at', 'enabled', 'clinic_id', 'count'];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['description', 'type', 'value', 'start_at', 'expires_at', 'enabled', 'clinic_id', 'count'];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['name'];

    /**
     *
     */
    protected CartsItemService$cartService;

    public function __construct(CartsItemService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     *
     */
    public function builder(): Builder
    {
        // dd(Coupon::query());
        return Coupon::query();

    }

    /**
     * @throws Exception
     */
    public function apply(array $attribute): Result
    {
        $coupon = $this->getCouponByName($attribute['name']);
        if (!$this->isValidCoupon($coupon)) {
            throw  new Exception('coupon code not valid try another code');
        }
        $newColumn = [];
        $cart = $this->cartService->getUserCart();
        $cartService = $cart->cartService()->first();
        if (!($coupon->min_amount) || $coupon->min_amount < $cartService->price) {
            if (isset($coupon->min_amount) && $coupon->min_amount > $cartService->price) {
                $max = 0;
            } else {
                $discount = $this->cartService->calcDiscount($cartService->price, $coupon->type, $coupon->value, $coupon->percent_limited);
                $max = $discount;
            }
            $price = number_format($cartService->price - $max, 2, '.', '');

            $newRewards =($cartService->price - $max)*100;
            $newRewards  = number_format( $newRewards , 2, '.', '');

            $newPrice = number_format($price, 2, '.', '');
            $newColumn["total_rewards"] = $newRewards;
            $newColumn["total_price"] = $newPrice;
            $newColumn["coupon_id"] = $coupon->id;
            $coupon->update(["count" => $coupon->count - 1]);

            return $this->ok($this->cartService->update($cartService->id, $newColumn), "coupon Applied  successful");

        }
        throw new Exception("coupon code not valid try another code");
    }

    /**
     * @throws Exception
     */
    public function removeCoupon(): Result
    {
        $cart = $this->cartService->getUserCart();
        $cartService = $cart->cartService()->first();
        if (isset($cartService->coupon_id)) {
            $coupon = $this->find($cartService->coupon_id);
            if (isset($coupon->count)) {
                $coupon->update(["count" => $coupon->count + 1]);
            }
        }
        $newColumn["total_price"] = $cartService->price;
        $newRewards =($cartService->price )*100;
        $newRewards= number_format( $newRewards , 2, '.', '');

        $newColumn["total_rewards"] =$newRewards;
        $newColumn["coupon_id"] = Null;
        return $this->ok($this->cartService->update($cartService->id, $newColumn), "coupon removed  successful");

    }

    public function getCouponByName($name)
    {
        return Coupon::where('name', $name)->first();
    }

    /**
     * is valid coupon
     * @throws Exception
     */
    public function isValidCoupon($coupon): bool
    {
        if ($coupon instanceof Coupon) {
            $count = $coupon->where('start_at', '<=', now())->where('expires_at', '>=', now())->count();
            if ($count === 0) {
                return false;
            }
            return true;
        }
        return false;
    }

    private function calcDiscount($price, $type, $value, $max)
    {
        return match ($type) {
            "percent_limited" => max(($price * $value) / 100, $price - $max),
            "fixed" => $price - max($value, $max),
            "percent" => ($price * $value) / 100,
            default => 0,
        };
    }

    /**
     * create a new coupon
     * @throws Exception
     */
    public function store(array $attributes): Model
    {
        //
        //
        // $this->attachRelations($record, $attributes);

        return parent::store($attributes);
    }

    private function attachRelations(Coupon $coupon, array $attributes): void
    {
        //
        // 1. store or update users
        //
        //  dd($attributes);
        if (isset($attributes['users'])) {
            $users = (array)$attributes['users'];
            // $coupon->users()->detach();
            //  $coupon->users()->attach($users, ['site_id' => 1]);
        }
        //
        // 2. store or update services
        //
        if (isset($attributes['services'])) {
            $services = (array)$attributes['services'];
            //  $coupon->services()->detach();
            //    $coupon->services()->attach($services);
        }
    }

    /**
     * save coupon
     * @throws Exception
     */
    public function update($id, array $attributes): Model
    {
        //
        //  $this->attachRelations($record, $attributes);
        return parent::update($id, $attributes);
    }
}