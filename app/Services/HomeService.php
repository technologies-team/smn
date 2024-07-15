<?php


namespace App\Services;


use App\DTOs\Result;
use App\DTOs\SearchQuery;
use App\DTOs\SearchResult;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use Exception;

class HomeService extends Service
{

private  BannerService $bannerService;

    private CategoryService $categoryService;

    private FoodService $foodService;
    private KitchenService $kitchenService;
    private Order $orderService;
    public function __construct(BannerService $bannerService, CategoryService $categoryService,FoodService $foodService,KitchenService $kitchenService)
    {
        $this->bannerService=$bannerService;
        $this->foodService=$foodService;
        $this->categoryService=$categoryService;
        $this->kitchenService=$kitchenService;
    }

    /**
     * @throws Exception
     */
    public function index($fromJson): Result
    {
        unset($fromJson->fields["language"]);
        $result['banner']=$this->bannerService->search($fromJson);
        $result['kitchen']=$this->kitchenService->search($fromJson);
        $result['category']=$this->categoryService->search($fromJson);
        $result['food']=$this->foodService->search($fromJson);
        $result['statistics']=$this->getStatistics();
        return $this->ok($result, 'records:create:done');

    }
    public function getStatistics(): array
    {
        return ["orderCount"=>12,'clientCount'=>8];
    }

    public function kitchenHome(SearchQuery $fromJson): Result
    {
        unset($fromJson->fields["language"]);
        $records = Order::orderBy('status')->orderBy('id')->get();

        $grouped = $records->groupBy('status')->map(function ($group) {
            return $group->take(5);
        });

        $orders = $grouped->flatten();
        $data=array();
        foreach ($orders as $order ){
            $data[$order->status][]=$order;
        }
        $data['statistics']=$this->getStatistics();
        return $this->ok($data, 'records:create:done');
    }

}
