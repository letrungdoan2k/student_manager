<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectRepository;
    public function __construct(SubjectRepositoryInterface $subjectRepository) {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subjectRepository->getPage(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = new Subject();
        $method = 'POST';
        $array = [
            'route' => 'subjects.store',
            'id' => ''
        ];
        return view('admin.subjects.createUpdate', compact('subjects', 'method', 'array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectRepository->create($request->all());

        return redirect(route('subjects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = $this->subjectRepository->find($id);
        return view('admin.subjects.detail', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = $this->subjectRepository->find($id);
        $method = 'PATCH';
        $array = [
            'route' => 'subjects.update',
            'id' => $id
        ];
        return view('admin.subjects.createUpdate', compact('subjects', 'method', 'array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
        $this->subjectRepository->update($id, $request->all());
        return redirect(route('subjects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subjectRepository->delete($id);
        return redirect(route('subjects.index'));
    }
}
