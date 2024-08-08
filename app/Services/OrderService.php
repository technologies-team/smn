<?php


namespace App\Services;


use App\DTOs\Result;
use App\Http\Requests\OrderRequest;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ClientFeedback;
use App\Models\Food;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderLog;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Ignition\Tests\TestClasses\Models\Car;

class OrderService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'user_id',
        'kitchen_id',
        'status',
        'price',
        'total_price',
        'rewards',
        'total_rewards',
        'discount',
        'total_discount',
        'total_fee',
        'shipping',
        'total_shipping',
        'notes',
        'payment_method',
        'order_time'];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['status'];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
        protected array $with = [ 'kitchen','orderDetail'];

    public function builder(): Builder
    {
        return Order::query();
    }

    protected OrderDetailService $detailService;
    protected OrderLogService $logService;
    protected CartsService $cartsService;
    protected LocationService $locationService;

    public function __construct(OrderDetailService $detailService, OrderLogService $logService, CartsService $cartsService, LocationService $locationService)
    {
        $this->logService = $logService;
        $this->detailService = $detailService;
        $this->cartsService = $cartsService;
        $this->locationService = $locationService;
    }

    /**
     * @throws Exception
     */
    public function createOrder($kitchen_id, $attributes): Result
    {
        $location = null;
        if (isset($attributes['location_id'])) {
            $location = $this->locationService->find($attributes['location_id']);
            if (!$this->checkLocation($location)) {
                throw  new Exception("not valid location ");
            }
        }

        $cart = $this->cartsService->getUserCart($kitchen_id);
        if (empty($cart->item()->first())) {
            throw new Exception("empty Cart");
        }

        $items = $cart->item()->without("kitchen")->get();

        if (empty($items)) {
            return $this->ok([], "cart is empty");
        }
        $attributes["price"] = $cart->price;
        $attributes["total_price"] = $cart->total_price;
        //when we add shipping
        $attributes["shipping"] = 0;
        $attributes["rewards"] = 0;
        $attributes["total_rewards"] = 0;
        $attributes["discount"] = 0;
        $attributes["kitchen_id"] = $kitchen_id;
        //dd($attributes);
        $order = $this->store($attributes);
        if ($order instanceof Order) {
            $details = array();
            if ($location) {
                $details['location'] = json_encode($location);
            }
            $details['items'] = json_encode($items);
            $order->orderDetail()->create($details);
        }
        foreach ($items as $item) {
            unset($item->food->option);
            unset($item->food->kitchen);

        }
        $cart->delete();

        return $this->ok($this->find($order->id), "order create done");
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }

    public function store(array $attributes): Model
    {
        $id = auth()->user()->getAuthIdentifier();

        $attributes['user_id'] = $id;
        return parent::store($attributes);
    }

    protected function checkLocation($location): bool
    {
        if ($location instanceof Location) {

            return true;
        }
        return false;
    }

    public function isLocationInDubai($long, $lat): bool
    {

        // Define the boundaries of Dubai (approximate values)
        $dubaiBounds = ['min_latitude' => 24.75, 'max_latitude' => 25.35, 'min_longitude' => 55.10, 'max_longitude' => 56.50,];

        // Check if the coordinates fall within the boundaries of Dubai
        return $lat >= $dubaiBounds['min_latitude'] && $lat <= $dubaiBounds['max_latitude'] && $long >= $dubaiBounds['min_longitude'] && $long <= $dubaiBounds['max_longitude'];
    }

    /**
     * @throws Exception
     */
}
