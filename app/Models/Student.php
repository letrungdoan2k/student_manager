<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthday', 'address', 'phone', 'email', 'gender','image' , 'faculty_id'];

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
