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
        $this->middleware(['role:admin']);
    }

    public function index()
    {
        $students = $this->studentRepository->average_score();
        return view('admin.students.studentMail', compact('students'));
    }

    public function store()
    {
        $this->studentRepository->sendMail(10);
        return redirect(route('mail.index'))->with('success', 'Email sent successfully');
    }
}
