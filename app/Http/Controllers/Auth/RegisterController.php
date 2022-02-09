<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $userRepository;
    protected $studentRepository;

    public function __construct(UserRepositoryInterface $user, StudentRepositoryInterface $student)
    {
        $this->userRepository = $user;
        $this->studentRepository = $student;
    }

    public function signupForm()
    {
        return view('auth.register');
    }

    public function postSignup(RegisterRequest $request)
    {
        $request = $request->all();
        $request['password'] = bcrypt($request['password']);
        $request['user_id'] = $this->userRepository->create($request)->id;
        $this->studentRepository->create($request);
        return redirect(route('login'));
    }
}
