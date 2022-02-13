<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
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
        dd($social);
        if ($social === 'facebook' || $social === 'twitter') {
            $getInfo = Socialite::driver($social)->user();
        }
        if ($social === 'google') {
            $getInfo = Socialite::driver($social)->with(['access_type' => 'offline'])->stateless()->user();
        }
        $user = $this->userRepository->createUser($getInfo, $social);
        $this->studentRepository->loginSocial($getInfo, $user);
        auth()->login($user);
        return redirect()->route('dashboard');
    }
}
