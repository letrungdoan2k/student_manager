<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StudentRequest;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $facultyRepository;
    protected $subjectRepository;
    protected $userRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, FacultyRepositoryInterface $facultyRepository, SubjectRepositoryInterface $subjectRepository, UserRepositoryInterface $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->facultyRepository = $facultyRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->all();
        $studentAll = $this->studentRepository->search($request);
        $subjects = $this->subjectRepository->getAll();
        $countSubject = $this->subjectRepository->count();
        $studentDone = $this->studentRepository->done($countSubject);
        $studentUnfinised = $this->studentRepository->unfinished($countSubject);
        return view('admin.students.index', compact('studentAll', 'studentDone', 'studentUnfinised', 'subjects', 'request'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $request = $request->all();
        $request['password'] = bcrypt($request['password']);
        $request['user_id'] = $this->userRepository->create($request)->id;
        $countSubject = $this->subjectRepository->count();
        $this->studentRepository->createStudent($request, $countSubject);
        return redirect(route('students.index'))->with('success', 'Successfully added student');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->profile($id);
        return view('admin.students.profile', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->findOrFail($id);
        $faculties = $this->studentRepository->arrayIdName($this->facultyRepository->getAll());
        $subjects = $this->studentRepository->arrayIdName($this->subjectRepository->getAll());
        $genders = $this->studentRepository->arrGender();
        return view('admin.students.create_update', compact('faculties', 'genders', 'student', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $countSubject = $this->subjectRepository->count();
        $student = $this->studentRepository->updateStudent($id, $request->all(), $countSubject);
        if (Auth::user()->id == $student->user_id){
            return redirect()->route('logout');
        }
        return redirect()->route('students.index')->with('success', 'Student update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = $this->studentRepository->deleteStudent($id);
        $this->userRepository->delete($user_id);
        return redirect(route('students.index'))->with('success', 'Delete student successfully');
    }

    //API function
    //list subject
    public function listSubject()
    {
        $subjects = $this->subjectRepository->getAll();
        return response()->json($subjects);
    }

    //profile student
    public function profile($id)
    {
        $student = $this->studentRepository->findOrFail($id);
        return response()->json($student);
    }

    //profile update
    public function profileUpdate(Request $request, $id)
    {
        $student = $this->studentRepository->update($id, $request->all());
        return response()->json($student);
    }

    //
    public function profileUpdateImage(Request $request, $id)
    {
        return response()->json($request->all());
    }

}
