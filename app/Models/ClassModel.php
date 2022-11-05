<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = [
        "name",
        "description"
    ];

    public function students ()
    {
        return $this->belongsToMany(StudentModel::class, 'student_class', 'class_id', 'student_id');
    }
}
