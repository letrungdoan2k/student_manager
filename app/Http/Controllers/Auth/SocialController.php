<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepository = $user;
    }

    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $getInfo = Socialite::driver($social)->user();
        $user = $this->createUser($getInfo,$social);
        auth()->login($user);
        return redirect()->to('/');
    }
}
