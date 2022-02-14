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
        $user = $this->model->where('provider', $social)->where('provider_id', $getInfo->id)->first();
        if (!$user && $social === 'facebook') {
            $user = $this->model->create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $social,
                'provider_id' => $getInfo->id
            ]);
        }
        if (!$user && $social === 'twitter') {
            $user = $this->model->create([
                'name'     => $getInfo->name,
                'provider' => $social,
                'provider_id' => $getInfo->id
            ]);
        }
        if (!$user && $social === 'google') {
            $user = $this->model->create([
                'name'     => $getInfo->getName(),
                'email'    => $getInfo->getEmail(),
                'provider' => $social,
                'provider_id' => $getInfo->getId()
            ]);
        }
        return $user;
    }

}
