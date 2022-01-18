<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthday', 'address', 'phone', 'email', 'gender', 'image', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id')->withPivot(['point']);
    }

    public function student_subject()
    {
        return $this->belongsTo( 'student_subject', 'student_id');
    }

    const MALE = 'Nam';
    const FEMALE = 'Nữ';

    public function getGenderTextAttribute()
    {
        return $this->gender == 1 ? Student::MALE : Student::FEMALE;
    }
}
