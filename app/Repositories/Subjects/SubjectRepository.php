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
}
