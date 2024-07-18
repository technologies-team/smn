<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Kitchen;
use App\Models\KitchenAvailability;
use App\Models\KitchenSetting;
use App\Models\KitchenSocialLink;
use App\Models\User;
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
        'pickup'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'kitchen_id',
        'delivery_type',
        'pickup'
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */

    public function builder(): Builder
    {
        return KitchenSetting::query();
    }

    public function setting(): Result
    {
        $user = auth()->user();
        if ($user instanceof User) {
            $kitchen = $user->kitchen()->first();
            if ($kitchen instanceof Kitchen) {
                $data['setting'] = $kitchen->setting()->first();
                $data['availability'] = $kitchen->availability()->get();
                $data['social'] = $kitchen->social()->first();
                return $this->ok($data, 'get kitchen setting done');
            }
        }

        return $this->ok([], "you didn't have a kitchen ");

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
        $data = array();

        $user = auth()->user();
        $kitchen = $user->kitchen()->first();
        if ($kitchen instanceof Kitchen) {
            if (isset($attributes["availability"])) {
                $available = $attributes["availability"];
                foreach ($available as $availability) {
                    $data['availability'][] = $kitchen->availability()->updateOrCreate($availability);

                }

            }
            if ($attributes["setting"]) {
                $setting = $attributes["setting"];
                $data['setting'] = $kitchen->setting()->updateOrCreate($setting);

            }
            if ($attributes["social"]) {
                $social = $attributes["social"];
                $data['social'] = $kitchen->social()->updateOrCreate($social);

            }
        }
        return $this->ok($data, "record save done");
    }

    /**
     * @throws Exception
     */
}
