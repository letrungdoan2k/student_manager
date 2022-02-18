<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepository = $user;
    }

    public function permission(Request $request, $id)
    {
        $this->userRepository->setPermission($id, $request->all());
        return redirect()->back();
    }
}
