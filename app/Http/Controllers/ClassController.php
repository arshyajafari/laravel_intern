<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

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
        // with('studentsInClass')
        return response()->json(
            ClassModel::get()
        );
    }

    public function getById (string $id): JsonResponse
    {
        $class = ClassModel::where('id', $id)->with('studentsInClass')->first();

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
}
