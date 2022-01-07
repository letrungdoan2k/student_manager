<?php
namespace App\Repositories\Students;

use App\Repositories\BaseRepository;

class StudentReponsitory extends BaseRepository implements StudentReponsitoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }
}
