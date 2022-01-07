<?php
namespace App\Repositories\Students;

use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }
}
