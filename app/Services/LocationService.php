<?php

namespace App\Services;

use App\DTOs\Result;
use App\Models\Location;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class LocationService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = ['title', 'street1', 'street2', 'phone', 'verified', 'country_id', 'city_id', 'longitude', 'latitude', 'user_id', 'parking_type', 'country', 'city'];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['street1', 'street2', 'country', 'phone', 'verified', 'city', 'zip_code', 'longitude', 'latitude'];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = [];

    /**
     *
     */
    protected array $with = [];

    /**
     *
     */
    public function builder(): Builder
    {
        return Location::query();
    }

    /**
     * @throws Exception
     */
    public function create(array $attributes): Result
    {
        if (!$this->isLocationInDubai($attributes["longitude"], $attributes["latitude"])) {
            throw  new  Exception("this location not allowed to our service");
        }
        $user = auth()->user();
        if ($user instanceof User) {

            if (!isset($attributes['user_id'])) {

                $attributes['user_id'] = $user->id;
            }
            $location = $user->locations()->where("phone", $attributes['phone'])->get()->first();
            if ($location instanceof Location) {
                $attributes["verified"] = true;
            }
            if ($user->phone == $attributes['phone']) {
                $attributes["verified"] = true;

            }
        }

        return $this->ok($this->store($attributes), 'location:saved:succeeded');
    }

    public function isLocationInDubai($long, $lat): bool
    {

        // Define the boundaries of Dubai (approximate values)
        $dubaiBounds = ['min_latitude' => 24.75, 'max_latitude' => 25.35, 'min_longitude' => 55.10, 'max_longitude' => 56.50,];

        // Check if the coordinates fall within the boundaries of Dubai
        return $lat >= $dubaiBounds['min_latitude'] && $lat <= $dubaiBounds['max_latitude'] && $long >= $dubaiBounds['min_longitude'] && $long <= $dubaiBounds['max_longitude'];
    }

    public function save($id, array $attributes): Result
    {
        if (isset($attributes["longitude"]) && isset($attributes["latitude"])) {
            if (!$this->isLocationInDubai($attributes["longitude"], $attributes["latitude"])) {
                throw  new  Exception("this location not allowed to our service");
            }
        }
        if (isset($attributes["verified"]) && $attributes["verified"]) {
            $user = auth()->user();
            $location = $this->find($id);
            if ($location->user_id != $user->id) {
                throw new Exception("this function not authorized");
            }
            if ($user instanceof User) {

                if (!isset($attributes['user_id'])) {

                    $attributes['user_id'] = $user->id;
                }
                $locations = $user->locations()->get();
                foreach ($locations as $location) {
                    if ($location instanceof Location) {
                        $location->update(["verified" => true]);
                    }
                }
            }
        }
        return parent::save($id, $attributes); // TODO: Change the autogenerated stub
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }
}

