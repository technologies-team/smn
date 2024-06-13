<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
use App\Models\CartService;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Tests\Thing1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CartsService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = ['user_id', 'kitchen_id', 'total_price','coupon_id','offer_id'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['total_price','coupon_id','offer_id'];
/**
 * *
**/
    protected array $with = [];

    public function builder(): Builder
    {
        return Cart::query();
    }
}
