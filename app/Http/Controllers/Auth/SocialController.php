<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    protected $userRepository;
    protected $studentRepository;

    public function __construct(UserRepositoryInterface $user, StudentRepositoryInterface $student)
    {
        $this->userRepository = $user;
        $this->studentRepository = $student;
    }

    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $getInfo = Socialite::driver($social)->user();
        $user = $this->userRepository->createUser($getInfo,$social);
        $this->studentRepository->create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'user_id' => $user->id,
        ]);
        auth()->login($user);
        return redirect()->to('/');
    }
}
