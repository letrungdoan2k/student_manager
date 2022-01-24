<?php

namespace App\Repositories\Students;

use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function createStudent($attributes)
    {
        if (!empty($attributes['image'])) {
            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        dd($attributes['subject_id']);
        $student = $this->model->create($attributes);
        if (isset($attributes['subject_id'])) {
                $student->subjects()->sync([$attributes['subject_id'] => ['point' => $attributes['point']]]);

        }
    }

    public function updateStudent($id, $attributes)
    {
        $result = $this->findOrFail($id);
        if (!empty($attributes['image'])) {
            Storage::delete($result->image);

            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        return $result->update($attributes);
    }

    public function deleteStudent($id)
    {
        $result = $this->findOrFail($id);
        $image = str_replace('images/', '', $result->image);
        Storage::delete($image);
        return $result->delete();
    }

    public function arrGender()
    {
        $array = [
            '1' => $this->model::MALE,
            '2' => $this->model::FEMALE
        ];
        return $array;
    }
}
