<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\StripePayment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use function Laravel\Prompts\error;

class StripePaymentService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'id',
        'payment_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'description',
        'receipt_url',
        'payment_date',
    ];
    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'status',
        'receipt_url',
    ];
    public function builder(): Builder
    {
        return StripePayment::query();
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }

    /**
     * @throws Exception
     */
    public function create(array $attributes): Result
    {
        $user_id=auth()->id();
        $data = $this->store([
            'payment_id' => $attributes["id"],
            'user_id' =>  $user_id,
            'amount' => $attributes['amount'],
            'currency' => $attributes['currency'],
            'status' =>"created",
            'description' => "smn food",
            'payment_date' => now(),
        ]);
        return$this->ok($data,"payment created success");
    }  public function save($id,array $attributes): Result
    {
      $recode=  $this->find($id);
      if($recode instanceof StripePayment){


        $user_id=auth()->id();
      if($recode->user_id==$user_id){
          $data = $this->update($id,['status' =>"paid"]);
      }
      }
      else throw new Exception("payment not created");
        return$this->ok($recode,"payment created success");
    }

    public function findBy(string $name, $value)
    {
      return  StripePayment::where($name,'=',$value)->first();
    }
}
