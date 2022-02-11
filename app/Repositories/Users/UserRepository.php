<?php
namespace App\Repositories\Users;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function createUser($getInfo,$social){
        $user = $this->model->where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = $this->model->create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $social,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }

}
