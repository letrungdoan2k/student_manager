<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $facultyRepository;
    protected $subjectRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, FacultyRepositoryInterface $facultyRepository, SubjectRepositoryInterface $subjectRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->facultyRepository = $facultyRepository;
        $this->subjectRepository = $subjectRepository;
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
        $faculties = $this->studentRepository->arrayIdName($this->facultyRepository->getAll());
        $subjects = $this->studentRepository->arrayIdName($this->subjectRepository->getAll());
        $genders = $this->studentRepository->arrGender();
        $student = $this->studentRepository->newModel();
        return view('admin.students.create_update', compact('faculties', 'subjects', 'genders', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
//        dd($request->all());
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
        $student = $this->studentRepository->find($id);
        if (!$student) {
            return redirect(route('students.index'));
        }
        $faculties = $this->studentRepository->arrayIdName($this->facultyRepository->getAll());
        $subjects = $this->studentRepository->arrayIdName($this->subjectRepository->getAll());
        $genders = $this->studentRepository->arrGender();
        return view('admin.students.create_update', compact( 'faculties', 'genders', 'student', 'subjects'));
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
        $this->studentRepository->updateStudent($id, $request->all());

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->studentRepository->deleteStudent($id);
        return redirect(route('students.index'));
    }
}
