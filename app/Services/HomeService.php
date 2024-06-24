<?php


namespace App\Services;


use App\DTOs\Result;
use App\DTOs\SearchQuery;
use App\DTOs\SearchResult;
use App\Models\Banner;
use App\Models\Category;
use Exception;

class HomeService extends Service
{

private  BannerService $bannerService;

    private CategoryService $categoryService;

    private FoodService $foodService;
    private KitchenService $kitchenService;
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
        return $this->ok($result, 'records:create:done');

    }
}
