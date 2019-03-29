<?php

namespace App\Data\Repositories;

use App\Data\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Repository
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findUserById($id)
    {
        return User::find($id);
    }

    /**
     * @param $request
     * @param $remember
     *
     * @return User
     */
    public function updateLoginUser($request, $remember, $response)
    {
        try {
            $credentials = extract_credentials($request);

            if (
                is_null(
                    $user = $this->findUserByEmail(
                        $email = "{$credentials['username']}@alerj.rj.gov.br"
                    )
                )
            ) {
                $user = new User();

                $user->username = $credentials['username'];

                $user->email = $email;
            }

            $user->name = $response['data']['name'][0];

            $user->password = Hash::make($credentials['password']);

            $user->save();
        } catch (\Exception $exception) {
            report($exception);

            return null;
        }

        return $user;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return User::orderBy('name')->get();
    }

    /**
     * @return mixed
     */
    public function notifiables()
    {
        return User::where('all_notifications', true)->get();
    }

    /**
     * @param $user
     * @param $permission
     * @return bool
     */
    public function userHasPermission($user, $permission)
    {
        return in_array($permission, $user->permissions_array);
    }

    /**
     * @param $user
     * @return bool
     */
    public function userHasAnyPermission($user)
    {
        return count($user->permissions_array) > 0;
    }

    public function updatePerPage($user, $size)
    {
        $user->per_page = $size;

        $user->save();

        return $user;
    }
}