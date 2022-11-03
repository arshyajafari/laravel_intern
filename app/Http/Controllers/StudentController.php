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
            "email" => ['required', 'email', 'max:100'],
            "phone_number" => ['required', 'string', 'max:20'],
            "national_code" => ['required', 'string', 'max:15'],
            "birth_date" => ['required', 'string', 'max:15'],
            "state" => ['required', 'string', 'max:100'],
            "city" => ['required', 'string', 'max:100'],
            "gender" => ['required', 'string', 'max:100'],
            "password" => ['required', 'string', 'max:100'],
            "class_id" => ['string', 'max:20']
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

    public function get (Request $request)
    {
        $eloquent = (new StudentModel())->with('studentsInClass');

        $queries = $request->validate([
            'class_id' => ['string', 'max:20']
        ]);

        if (isset($queries['class_id']))
        {
            $eloquent = $eloquent->whereHas('studentsInClass', function ($query) use ($queries)
            {
                $query->where('classes.id', $queries['class_id']);
            });
        }

        return response()->json(
            $eloquent->get()
        );
    }

    public function getById (string $id): JsonResponse
    {
        $student = StudentModel::where('id', $id)->first();

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
