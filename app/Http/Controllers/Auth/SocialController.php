<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($social)
    {
//        switch ($social){
//            case 'facebook':
//                return Socialite::driver($social)->redirect();
//                back();
//        }
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $info = Socialite::driver($social)->user();
        dd($info);
        // Sau khi xác thực Facebook chuyển hướng về đây cùng với một token
        // Các xử lý liên quan đến đăng nhập bằng mạng xã hội cũng đưa vào đây.
    }
}
