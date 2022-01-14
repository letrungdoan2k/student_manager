<?php

namespace App\Repositories\Students;

use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\BaseRepository;
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
        $student = $this->model->create($attributes);
        if (isset($attributes['subject_id'])) {
            for ($i = 1; $i <= count($attributes['subject_id']); $i++) {
                $student->subjects->student_id = $student->id;
                $student->subjects->subject_id = $attributes['subject_id'][$i];
                $student->subjects->point = $attributes['point'][$i];
//                dd($student->subjects);
                $student->subjects->save();
            }
        }
    }

    public function updateStudent($id, $attributes)
    {
        $result = $this->find($id);
        if (!$result) {
            return redirect(route('students.index'));
        }
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

    public function arrayIdName($array)
    {
        $array = $array->pluck('name', 'id');
        return $array;
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
