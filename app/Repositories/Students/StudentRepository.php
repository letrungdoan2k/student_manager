<?php
namespace App\Repositories\Students;

use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function createStudent($attributes) {
        if(!empty($attributes['image'])){
            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        return $this->model->create($attributes);
    }

    public function arrFaculty() {
        $array = [];
        $faculties = Faculty::all();
        foreach ($faculties as $value){
            $array[$value->id] = $value->name;
        }
        return $array;
    }

    public function arrGender() {
        $array = [
            '1' => 'Nam',
            '2' => 'Nữ'
        ];
        return $array;
    }
}
