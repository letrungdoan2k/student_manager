<?php

namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function createStudent($attributes, $countSubject);

    public function updateStudent($id, $attributes, $countSubject);

    public function deleteStudent($id);

    public function arrGender();

    public function search($request);

    public function profile($id);

    public function sendMail($pageNumber);

    public function loginSocial($getInfo, $user, $social);

    public function addSubjectStudent($id, $request);

    public function updateImage($id, $request);

}
