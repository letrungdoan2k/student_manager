<?php
namespace App\Repositories\Faculties;

use App\Models\Faculty;
use App\Repositories\BaseRepository;

class FacultyReponsitory extends BaseRepository implements FacultyReponsitoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }
}
