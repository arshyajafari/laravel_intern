<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function store (Request $request): JsonResponse
    {
        $data = $request->validate([
            "full_name" => ['required', 'string', 'max:150'],
            "email" => ['required', 'email', 'max:100', 'unique:students'],
            "phone_number" => ['required', 'string', 'max:20'],
            "national_code" => ['required', 'string', 'max:15'],
            "birth_date" => ['required', 'string', 'max:15'],
            "state" => ['required', 'string', 'max:100'],
            "city" => ['required', 'string', 'max:100'],
            "gender" => ['required', 'string', 'max:100'],
            "password" => ['required', 'string', 'max:100']
        ]);

        $data['password'] = Hash::make($data['password']);

        $student = StudentModel::create($data);

        DB::table('student_class')->insert([
            'class_id' => $data['class_id'],
            'student_id' => $student->id,
        ]);

        return response()->json([
            'message' => 'student stored successfully'
        ]);
    }

    public function get ()
    {
        return response()->json(
            StudentModel::get()
        );
    }

    public function getById (string $id): JsonResponse
    {
        $student = StudentModel::where('id', $id)->with('classes')->first();

        if (! empty($student))
        {
            return response()->json(
                $student
            );
        }

        return response()->json(
            [
                'code' => '1',
                'message' => 'student not found'
            ],
            404
        );
    }
}
