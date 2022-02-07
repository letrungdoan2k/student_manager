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

    // filter
    public function search($request, $pageNumber = 10)
    {
        // filter age
        $query = $this->model->query();
        $minAge = isset($request['from-age']) ? $request['from-age'] : '';
        $maxAge = isset($request['to-age']) ? $request['to-age'] : '';
        if ($minAge != '') {
            $ageMin = Carbon::now()->subYears($minAge)->toDateString();
            $query->where('birthday', '<=', $ageMin);
        }
        if ($maxAge != '') {
            $ageMax = Carbon::now()->subYears($maxAge)->toDateString();
            $query->where('birthday', '>=', $ageMax);
        }

        // filter phone
        if (!empty($request['phone'])) {
            $regex = '';
            if (in_array('viettel', $request['phone'])) {
                $regex .= '|(03[2-9]|09[6|7|8]|08[6])+([0-9]{7})';
            }
            if (in_array('vina', $request['phone'])) {
                $regex .= '|(09[1|4]|08[1-5|8])+([0-9]{7})';
            }
            if (in_array('mobi', $request['phone'])) {
                $regex .= '|(090|089|07[0|6-9])+([0-9]{7})';
            }
            $query->where('phone', 'regexp', ltrim($regex, '|'));
        }

        // filter point
        if (!empty($request['from-point']) || !empty($request['to-point'])) {
            $minPoint = isset($request['from-point']) ? $request['from-point'] : 0;
            $maxPoint = isset($request['to-point']) ? $request['to-point'] : 10;
            $query->whereHas('subjects', function ($query) use ($minPoint, $maxPoint) {
                $query->where('point', '>=', $minPoint)->where('point', '<=', $maxPoint);
            });
        }
        return $query->orderByDesc('updated_at')->paginate($pageNumber);
    }

    // create
    public function createStudent($attributes)
    {
        if (!empty($attributes['image'])) {
            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        $student = $this->model->create($attributes);
        $points = [];
        if (isset($attributes['subject_id'])) {
            $points = $attributes['subject_id'];
        }
        $student->subjects()->sync($points);
    }

    //update
    public function updateStudent($id, $attributes)
    {
        $result = $this->findOrFail($id);
        if (!empty($attributes['image'])) {
            Storage::delete($result->image);

            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        $result->update($attributes);
        $points = [];
        if (isset($attributes['subject_id'])) {
            $points = $attributes['subject_id'];
        }
        $result->subjects()->sync($points);
    }

    //delete
    public function deleteStudent($id)
    {
        $result = $this->findOrFail($id);
        $image = str_replace('images/', '', $result->image);
        Storage::delete($image);
        return $result->delete();
    }

    //gender array
    public function arrGender()
    {
        $array = [
            '1' => $this->model::MALE,
            '2' => $this->model::FEMALE
        ];
        return $array;
    }

    // Unfinished
    public function unfinished($countSubject, $pageNumber = 10)
    {
        $query = $this->model->query();
        $query->with('subjects')
            ->whereHas('subjects', null, 0)
            ->orWhereHas('subjects', null, '<', $countSubject);
        $student = $query->orderByDesc('updated_at')->paginate($pageNumber);
        return $student;
    }

    // Done
    public function done($countSubject, $pageNumber = 10)
    {
        $query = $this->model->query();
        $query->whereHas('subjects', null, $countSubject);
        return $query->orderByDesc('updated_at')->paginate($pageNumber);
    }
}
