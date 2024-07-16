<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Category;
use App\Models\KitchenAvailability;
use App\Models\KitchenSetting;
use App\Models\UserFcm;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class KitchenAvailabilityService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = ['kitchen_id', 'day_of_week', 'start_time', 'end_time'];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['kitchen_id', 'day_of_week', 'start_time', 'end_time'];
    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with = [];

    public function builder(): Builder
    {
        return KitchenAvailability::query();
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
    try {
        $record =parent::store($attributes);
    } catch (QueryException $e) {
        if ($e->errorInfo[1] != 1062) {
            throw new \Exception($e->getMessage());
        }
        else{

            KitchenAvailability::where('day', $attributes)->update(['user_id' => $user->id]);
        }
    }
    catch (\Exception $e){
        dd($e->getMessage());
    }

}
    /**
     * @throws Exception
     */
}
