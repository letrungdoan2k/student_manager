<?php
namespace App\Repositories\Subjects;

use App\Repositories\BaseRepository;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    // count subjects
    public function count() {
        return $this->model->count();
    }

    public function isSubjectCount($id) {
        $subjects = $this->model->whereHas('students', function ($query) use ($id) {
            $query->where('student_id', $id);
        })->get();
        $array = [];
        foreach ($subjects as $subject){
            $array[] = $subject->id;
        }
        $isSubject = $this->model->whereNotIn('id', $array)->get();
        return $isSubject;
    }
}
