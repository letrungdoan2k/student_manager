<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = $this->studentRepository->getPage(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->studentRepository->arrFaculty();
        $genders = $this->studentRepository->arrGender();
        $student = $this->studentRepository->newModel();
        $method = 'POST';
        $array = [
            'route' => 'students.store',
            'id' => ''
        ];
        return view('admin.students.createUpdate', compact('faculties', 'genders', 'student', 'method', 'array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $this->studentRepository->createStudent($request->all());

        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = $this->studentRepository->find($id);
        $faculties = $this->studentRepository->arrFaculty();
        $genders = $this->studentRepository->arrGender();
        $method = 'PATCH';
        $array = [
            'route' => 'students.update',
            'id' => $id
        ];
        return view('admin.students.createUpdate', compact( 'faculties', 'genders', 'students', 'method', 'array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->studentRepository->delete($id);
        return redirect(route('students.index'));
    }
}
