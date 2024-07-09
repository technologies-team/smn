<?php

namespace App\Services;

use App\DTOs\Result;
use App\Http\Responses\SuccessResponse;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthKitchenService extends UserService
{
    public function login( array $credentials,$role=User::ROLE_CUSTOMER): Result
    {
        return parent::login($credentials,User::ROLE_KITCHEN);
    }
    /**
     * @throws Exception
     */
    public function socialLogin($attributes,string $role=User::ROLE_KITCHEN): Result
    {
       return parent::socialLogin($attributes,User::ROLE_KITCHEN);
    }

    /**
     * @throws Exception
     */
    public function phoneLogin($attributes): Result
    {
        $user = $this->getUserBy("phone", $attributes["phone"]);
        return $this->loginRegister($user, $attributes,User::ROLE_KITCHEN);
    }

    /**
     * @throws Exception
     */
    public function register($attributes): Result
    {
        $attributes["role"]=User::ROLE_KITCHEN;
        $user = $this->store($attributes);
        if($user instanceof User) {

            $user->kitchen()->create(["title" => $attributes["kitchen_name"]]);
            $user = $this->ignoredFind($user->id);

            $data = [
                "user" => $user->toLightWeightArray(),
                "kitchen" => $user->kitchen()->first(),
                "token" => $user->createToken('*')->plainTextToken
            ];
        }
        return $this->ok($data,"register done");
    }

}
