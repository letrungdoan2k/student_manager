<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
        $this->middleware(['permission:delete'])->only(['destroy']);
        $this->middleware(['permission:edit'])->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = $this->facultyRepository->getPage();

        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = $this->facultyRepository->newModel();
        return view('admin.faculties.create_update', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        $this->facultyRepository->create($request->all());

        return redirect(route('faculties.index'))->with('success', 'Successfully added faculty');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = $this->facultyRepository->findOrFail($id);
        return view('admin.faculties.detail', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepository->findOrFail($id);
        return view('admin.faculties.create_update', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $this->facultyRepository->update($id, $request->all());
        return redirect(route('faculties.index'))->with('success', 'Faculty update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->facultyRepository->delete($id);
        return redirect(route('faculties.index'))->with('success', 'Delete faculty successfully');
    }

    //----------------------------API----------------------------------

    public function apiIndex()
    {
        $faculties = $this->facultyRepository->getAll();
        return response()->json($faculties);
    }

    public function apiRemove($id)
    {
        $this->facultyRepository->delete($id);
        return true;
    }

    public function apiStore(Request $request)
    {
        $this->facultyRepository->create($request->all());
        return true;
    }

    public function apiUpdate(Request $request, $id)
    {
        $this->facultyRepository->update($id, $request->all());
        return true;
    }
}
