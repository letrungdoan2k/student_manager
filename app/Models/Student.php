<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    const MALE = 'Nam';
    const FEMALE = 'Nữ';

    protected $fillable = ['name', 'birthday', 'address', 'phone', 'email', 'gender', 'image', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject')->withPivot(['point']);
    }

    public function getGenderTextAttribute()
    {
        return $this->gender == 1 ? Student::MALE : Student::FEMALE;
    }
}
