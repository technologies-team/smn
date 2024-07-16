<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Kitchen;
use App\Models\KitchenAvailability;
use App\Models\KitchenSetting;
use App\Models\KitchenSocialLink;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KitchenSettingService extends ModelService
{
    protected KitchenAvailability $kitchenAvailability;
    protected KitchenService $kitchenService;
    protected KitchenSocialLink $kitchenSocialLink;

    public function __construct(KitchenAvailability $kitchenAvailability, KitchenSocialLink $kitchenSocialLink, KitchenService $kitchenService)
    {
        $this->kitchenSocialLink = $kitchenSocialLink;
        $this->kitchenAvailability = $kitchenAvailability;
        $this->kitchenService = $kitchenService;
    }

    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'kitchen_id',
        'delivery_type',
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'kitchen_id',
        'delivery_type',
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with = ['photo'];

    public function builder(): Builder
    {
        return KitchenSetting::query();
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }
    public function create(array $attributes): Result
    {
        $data=array();
        $social=null;
        $availability=null;

        $kitchen=$this->kitchenService->find($attributes["kitchen_id"]);
      if($kitchen instanceof Kitchen){
          if(isset($attributes["availability"])){
              $availability=$attributes["availability"];
              $data['availability']= $kitchen->availability()->updateOrCreate($availability);

          }
          if($attributes["social"]){
              $social=$attributes["social"];
              $data['social']= $kitchen->social()->updateOrCreate($social);

          }    if($attributes["setting"]){
              $setting=$attributes["setting"];
              $data['setting']=KitchenSetting::updateOrCreate(  $setting);

          }
      }
        return $this->ok($data,"record save done");
    }

    /**
     * @throws Exception
     */
}
