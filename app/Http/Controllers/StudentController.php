<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = [
            'result' => [],
            'message' => 'Failed!'
        ];

        $data = Student::all();
        if($data){
            $response['result'] = $data;
            $response['message'] = 'Success!';
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentCreateRequest $request)
    {
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = [
            'result' => [],
            'message' => 'Failed!'
        ];

        $data = Student::findOrFail($id);
        if($data){
            $response['result'] = $data;
            $response['message'] = 'Success!';
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        return Student::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Student::find($id)->delete();

        if($deleted){
            return response(status:204);
        }

        return $deleted;
    }
}
