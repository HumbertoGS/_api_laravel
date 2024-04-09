<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function index()
    {

        $data = [];
        $students = student::all();

        if ($students->isEmpty()) {
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200
            ];
        } else {
            $data = [
                'students' => $students,
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:_student',
            'phone' => 'required|digits:10|unique:_student',
            'language' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 200
            ];
        } else {
            $student = student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'language' => $request->language
            ]);

            if (!$student) {
                $data = [
                    'message' => 'Error al crear el estudiante',
                    'status' => 500
                ];
            } else {
                $data = [
                    'student' => $student,
                    'status' => 201
                ];
            }
        }

        return response()->json($data);
    }

    public function showName($name)
    {

        $student = student::where('name', 'like', "$name%")->get();

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 200
            ];
        } else {
            $data = [
                'students' => $student[0],
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function show($id)
    {
        $student = student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 200
            ];
        } else {
            $data = [
                'students' => $student,
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $student = student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 200
            ];
        } else {

            $student->delete();

            $data = [
                'message' => 'Estudiante ha sido eliminado',
                'status' => 200
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $student = student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 200
            ];
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:_student',
                'phone' => 'required|digits:10|unique:_student',
                'language' => 'required',
            ]);

            if ($validator->fails()) {
                $data = [
                    'message' => 'Error en la validación de los datos',
                    'errors' => $validator->errors(),
                    'status' => 200
                ];
            } else {
                $student->name = $request->name;
                $student->email = $request->email;
                $student->phone = $request->phone;
                $student->language = $request->language;

                $student->save();

                $data = [
                    'message' => 'Estudiante ha sido actualizado',
                    'status' => 200
                ];
            }
        }

        return response()->json($data);
    }

    public function updatePartial(Request $request, $id)
    {
        $student = student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 200
            ];
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'max:255',
                'email' => 'email|unique:_student',
                'phone' => 'digits:10|unique:_student',
                'language' => '',
            ]);

            if ($validator->fails()) {
                $data = [
                    'message' => 'Error en la validación de los datos',
                    'errors' => $validator->errors(),
                    'status' => 200
                ];
            } else {

                if ($request->has('name')) {
                    $student->name = $request->name;
                }

                if ($request->has('email')) {
                    $student->email = $request->email;
                }

                if ($request->has('phone')) {
                    $student->phone = $request->phone;
                }

                if ($request->has('language')) {
                    $student->language = $request->language;
                }

                $student->save();

                $data = [
                    'message' => 'Estudiante ha sido actualizado',
                    'status' => 200
                ];
            }
        }

        return response()->json($data);
    }
}
