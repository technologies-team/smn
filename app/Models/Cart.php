<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
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
    protected $hidden = ['session_id'];
    protected $with = ['item',];

    public function item(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }



    /**
     * @throws Exception
     */
    public function addItem($item): Model
    {
        // Retrieve the Food item
        $food = Food::find($item->food_id);

        // Ensure the food item exists
        if (!$food) {
            // Handle the case where the food item is not found
            throw new \Exception("Food item not found.");
        }

        // Calculate price and total price based on the Food item
        $price = $food->price; // Assuming 'price' is an attribute of Food
        $totalPrice = $item->quantity * $price;

        // Create the cart item with the food's details
        return $this->item()->create([
            'food_id' => $food->id,
            'quantity' => $item->quantity,
            'price' => $price,
            'total_price' => $totalPrice,
        ]);
    }
}
