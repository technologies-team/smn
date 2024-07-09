<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
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
}
