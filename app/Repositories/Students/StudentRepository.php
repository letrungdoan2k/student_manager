<?php

namespace App\Repositories\Students;

use App\Jobs\SendEmail;
use App\Mail\SendMail;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    // filter
    public function search($request)
    {
        $pageNumber = 20;
            if (!empty($request['perPage'])) {
                $pageNumber = $request['perPage'];
            }
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
        return $query->orderByDesc('updated_at')->with('faculty')->paginate($pageNumber);
    }

    // create
    public function createStudent($attributes, $countSubject)
    {
        if (!empty($attributes['image'])) {
            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        $stt = 0;
        $attributes['status'] = 0;
        $countPoint = 0;
        $averagePoint = 0;
        if (isset($attributes['subjects'])) {
            foreach ($attributes['subject_id'] as $subject) {
                $stt++;
                $countPoint += $subject['point'];
            }
            $averagePoint = $countPoint / $stt;
            if (count($attributes['subjects']) == $countSubject) {
                $attributes['status'] = 1;
            }
        }
        $attributes['average_score'] = $averagePoint;
        $student = $this->model->create($attributes);
        $points = [];
        if (isset($attributes['subject_id'])) {
            $points = $attributes['subject_id'];
        }
        $student->subjects()->sync($points);
    }

    //update
    public function updateStudent($id, $attributes, $countSubject)
    {
        $result = $this->findOrFail($id);
        if (!empty($attributes['image'])) {
            Storage::delete($result->image);

            $imgPath = $attributes['image']->store('public/images');
            $imgPath = str_replace('public/', '', $imgPath);
            $attributes['image'] = $imgPath;
        }
        $stt = 0;
        $attributes['status'] = 0;
        $countPoint = 0;
        $averagePoint = 0;
        if (isset($attributes['subjects'])) {
            foreach ($attributes['subject_id'] as $subject) {
                $stt++;
                $countPoint += $subject['point'];
            }
            $averagePoint = $countPoint / $stt;
            if (count($attributes['subjects']) == $countSubject) {
                $attributes['status'] = 1;
            }
        }
        $attributes['average_score'] = $averagePoint;
        $result->update($attributes);
        $points = [];
        if (isset($attributes['subject_id'])) {
            $points = $attributes['subject_id'];
        }
        $result->subjects()->sync($points);
        return $result;
    }

    //delete
    public function deleteStudent($id)
    {
        $result = $this->findOrFail($id);
        $user_id = $this->findOrFail($id)->user_id;
        $image = str_replace('images/', '', $result->image);
        Storage::delete($image);
        $result->delete();
        return $user_id;
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
        $student = $query->orderByDesc('updated_at')->with('faculty')->paginate($pageNumber);
        return $student;
    }

    // Done
    public function done($countSubject, $pageNumber = 10)
    {
        $query = $this->model->query();
        $query->whereHas('subjects', null, $countSubject);
        return $query->orderByDesc('updated_at')->with('faculty')->paginate($pageNumber);
    }

    // profile
    public function profile($id)
    {
        $student = $this->model->query()->where('user_id', $id)->first();
        return $student;
    }

    public function updateImage($id, $request)
    {
        $result = $this->findOrFail($id);
        $imgPath = $request['image']->store('public/images');
        $imgPath = str_replace('public/', '', $imgPath);
        $attributes['image'] = $imgPath;
        $result->update($attributes);
        return $result;
    }


    // point < 5
    public function average_score($pageNumber = 10)
    {
        $students = $this->model->where('status', 1)->where('average_score', '<=', 5)->orderByDesc('updated_at')->paginate($pageNumber);
        return $students;
    }

    // sendEmail
    public function sendMail($pageNumber = 10)
    {
        $students = $this->model->where('status', 1)->where('average_score', '<=', 5)->orderByDesc('updated_at')->paginate($pageNumber);
        foreach ($students as $student) {
            $data = new SendMail($student);
            SendEmail::dispatch($data);
        }
        return true;
    }

    //
    public function loginSocial($getInfo, $user, $social)
    {
        $student = $this->model->where('user_id', $user->id)->first();
        if (!$student && $social == 'twitter') {
            $this->model->create([
                'name' => $getInfo->name,
                'user_id' => $user->id,
            ]);
        } elseif (!$student && ($social == 'google' || $social == 'facebook')) {
            $this->model->create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'user_id' => $user->id,
            ]);
        }
        return true;
    }

    // add subject student
    public function addSubjectStudent($id, $request)
    {
        $result = $this->findOrFail($id);
        if(isset($request['subject_id'])){
            $result->subjects()->attach($request['subject_id']);
        }
        $stt = 0;
        $countPoint = 0;
        foreach ($result->subjects as $result){
            $stt++;
            $countPoint += $result->pivot->point;
        }
        $attributes['average_score'] = $countPoint/$stt;
        $student= $this->findOrFail($id);
        $student->update($attributes);
        return $student;
    }

}
