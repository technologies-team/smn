<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Offer;
use App\Models\Option;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Tests\Thing1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CartsItemService extends ModelService
{
    protected FoodService $foodService;
    protected OptionService $optionService;

    public function __construct(FoodService $foodService, OptionService $optionService)
    {
        $this->foodService = $foodService;
        $this->optionService = $optionService;
    }

    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'food_id',
        'cart_id',
        'coupon_id',
        'offer_id',
        'price',
        'total_price',
        'discount',
        'options',
        'total_discount',
        'quantity',
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['tax',
        'food_id',
        'cart_id',
        'coupon_id',
        'offer_id',
        'price',
        'total_price',
        'discount',
        'options',
        'total_discount',
        'quantity',];
    /**
     * *
     **/
    protected array $with = [];

    public function builder(): Builder
    {
        return CartItem::query();
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

    public function store(array $attributes): Model
    {
        $food = $this->foodService->find($attributes["food_id"]);

        $price = $food->price;
        $conditions = [
            'food_id' => $attributes['food_id'],
            'cart_id' => $attributes['cart_id']
        ];
        if (isset($attributes["options"])) {
            foreach ($attributes["options"] as $id) {
                $option = $this->optionService->find($id);
                if ($option instanceof Option) {
                    $parent = $this->optionService->find($option->parent_id);
                    $options[$parent->name] = $option->name;
                    $price += $option->price;
                }
            }

            $attributes["options"] = json_encode($options);
        }
        $attributes['price'] = $price;
        $attributes["total_price"] = $attributes["price"] * $attributes["quantity"];
        if ($attributes["quantity"] <= 0) {
            return $food;
        }
        $updateAttributes = array_diff_key($attributes, $conditions);

        return $this->builder()->updateOrCreate($conditions, $updateAttributes);
    }

    private function getBy()
    {
    }
}
