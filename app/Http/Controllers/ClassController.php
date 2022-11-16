<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassResource;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClassController extends Controller
{
    public function store (Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        return response()->json(
            ClassModel::create($data)
        );
    }

    public function get (): JsonResponse {
        return response()->json(
            ClassResource::collection(ClassModel::with('students')->get())
        );
    }

    public function getById (string $id): JsonResponse
    {
        $class = ClassModel::where('id', $id)->with('students')->first();

        if (! empty($class))
        {
            return response()->json(
                $class
            );
        }

        return response()->json(
            [
                'code' => '1',
                'message' => 'class not found'
            ],
            404
        );
    }

    public function addStudentToClass (Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'string', 'max:20'],
            'class_id' => ['required', 'string', 'max:20'],
        ]);

        if (
            DB::table('student_class')
            ->where('student_id', $data['student_id'])
            ->where('class_id', $data['class_id'])
            ->exists()
        )
        {
            return response()->json(
                [
                    'code' => '2',
                    'message' => 'this student has been added to this class'
                ],
                ResponseAlias::HTTP_BAD_REQUEST
            );
        }

        DB::table('student_class')->insert([
            'class_id' => $data['class_id'],
            'student_id' => $data['student_id'],
        ]);

        return response()->json([
            "message" => "student added to class successfully"
        ]);
    }
}
