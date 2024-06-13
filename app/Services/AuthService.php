<?php

namespace App\Services;
use App\DTOs\Result;
use App\Models\User;
use Exception;

class AuthService extends UserService
{

    /**
     * login
     * @param array $credentials
     * @param string $role
     * @return Result
     * @throws Exception
     */
    public function login(array $credentials, $role = User::ROLE_CUSTOMER): Result
    {
        return parent::login($credentials,User::ROLE_CUSTOMER);
    }
    /**
     * login
     * @param array $credentials
     * @param string $role
     * @return Result
     * @throws Exception
     */
    public function register($attributes ): Result
    {
        return parent::register($attributes);
    }

    /**
     * @param $attributes
     * @param string $role
     * @return Result
     * @throws Exception
     */
    public function socialLogin($attributes, string $role=User::ROLE_CUSTOMER): Result
    {
      return parent::socialLogin($attributes,User::ROLE_CUSTOMER);
    }
    /**
     * @throws Exception
     */

}
