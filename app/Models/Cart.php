<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @method cartService()
 */
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
        'options',
        'total_price',
        'discount',
        'total_discount',
        'rewards',
        'total_rewards',
        'coupon_id',
        'offer_id',
    ];
    protected $hidden = ['session_id'];
    protected $with = ['item','kitchen'];
    protected $casts = [
        'price' => 'string',
        'total_price' => 'string',
        'rewards' => 'string',
        'total_rewards' => 'string',
        'discount' => 'string',
        'total_discount' => 'string',
        'total_fee' => 'string',
        'shipping' => 'string',
    ];
    public function item(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }    public function kitchen(): BelongsTo
{
        return $this->belongsTo(Kitchen::class);
    }
    public function getOptionsAttribute($value)
    {
        $decodedValue = json_decode($value, true);

        return $decodedValue ?? $value;
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
