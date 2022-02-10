<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->studentRepository = $student;
    }

    public function index()
    {
        return view('admin.mail.index');
    }

    public function store(Request $request)
    {
        $this->studentRepository->sendMail($request->all());
        return redirect(route('mail.index'));
    }
}
