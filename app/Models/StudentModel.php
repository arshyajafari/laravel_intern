<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentModel extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = [
        "full_name",
        "email",
        "phone_number",
        "national_code",
        "birth_date",
        "state",
        "city",
        "gender",
        "password",
        "class_id",
    ];

    protected $hidden = [
        'password'
    ];

    public function studentInClass()
    {
        return $this->belongsTo(ClassModel::class, "class_id", "id");
    }

    public function studentInClasses ()
    {
        return $this->belongsToMany(ClassModel::class, 'student_class', 'student_id', 'class_id');
    }
}
