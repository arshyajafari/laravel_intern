<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
            "password" => ['required', 'string', 'max:100'],
            "class_id" => ['string']
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

    public function updateStudentClass (Request $request,string $id)
    {
        $student = StudentModel::where('id', $id)->first();

        $data = $request->validate([
            "class_id" => ['string', 'max:20']
        ]);

        $class_id = array();

        array_push($class_id, $data['class_id']);

        foreach ($class_id as $value)
        {
            if ($student->class_id == $value)
            {
                return response()->json(
                    [
                        'code' => '2',
                        'message' => 'this student has been added to this class'
                    ],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        }

        StudentModel::where('id', $id)->update($data);

        DB::table('student_class')->insert([
            'class_id' => $data['class_id'],
            'student_id' => $id,
        ]);

        return response()->json([
            'message' => 'student\'s class has been updated successfully'
        ]);
    }

    public function get (Request $request)
    {
//        $eloquent = (new StudentModel())->with('studentInClasses');
//
//        $queries = $request->validate([
//            'class_id' => ['string', 'max:20']
//        ]);
//
//        if (isset($queries['class_id']))
//        {
//            $eloquent = $eloquent->whereHas('studentInClasses', function ($query) use ($queries)
//            {
//                $query->where('classes.id', $queries['class_id']);
//            });
//        }

        return response()->json(
            StudentModel::get()
        );
    }

    public function getById (string $id): JsonResponse
    {
        $student = StudentModel::where('id', $id)->with('studentInClasses')->first();

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
