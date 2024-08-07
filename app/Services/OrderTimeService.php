<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\BookDetail;
use App\Models\KitchenAvailability;
use App\Models\Order;
use Carbon\Carbon;
use PHPUnit\Logging\Exception;

class OrderTimeService extends Service
{
    protected KitchenAvailabilityService $availabilityService;

    public function __construct(KitchenAvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    public function OrderTime($id, $attributes): Result
    {
        $currentDate = isset($attributes["date"]) ? Carbon::parse($attributes["date"]) : Carbon::tomorrow();
        if ($currentDate->gt(Carbon::today()->addWeek())) {
            throw new Exception("The date cannot be more than one week from today.", 400);
        }
        if ($currentDate->lt(Carbon::today())) {
            throw new Exception("The date cannot be less than today.", 400);
        }
        if (isset($attributes["week_day"])) {
            $weekday = $attributes["week_day"];
            $time = $this->availabilityService->getWorkDayBy($id, "day", $weekday);

        } else {
            $time = $this->availabilityService->getWorkDayBy($id);
        }
        $availability = [];
        if ($time instanceof KitchenAvailability) {
            $availability["start_time"] = $time->start_time->format('H:i');
            $availability["end_time"] = $time->end_time->format('H:i');
            $startTime = $time->start_time;
            $endTime = $time->end_time;
            $availableTime = true;
        } else {
            $startTime = $currentDate->copy()->startOfDay()->hour(10);
            $endTime = $currentDate->copy()->endOfDay()->hour(22);
            $availableTime = false;
        }
        $availability = [];
        $currentTime = $startTime->copy();


        while ($startTime->lte($endTime)) {
            $availability[$startTime->format("H:i")] = $startTime->toDateTimeString();
            $startTime->addHour();
        }

        ksort($availability);

        $data = [];
        foreach ($availability as $time => $available) {
            $data[] = ["time" => $time, "available" => $availableTime];
        }


        return $this->ok($data, "available time");
    }


}
