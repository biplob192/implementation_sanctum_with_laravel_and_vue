<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class StudentController extends BaseController
{
    public function index()
    {
        $student = Student::get();
        return $this->sendResponse($student, 'All student data.');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'address' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::beginTransaction();
        try {
            $student = new Student();

            $student->name = $request->name;
            $student->email = $request->email;
            $student->address = $request->address;
            $student->phone = $request->phone;
            $student->save();

            DB::commit();
            return $this->sendResponse($student, 'Student created successfully.', 201);
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return $this->sendError('Record not found!');
        }
        return $this->sendResponse($student, 'Student data.', 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $student = Student::find($id);
            $student->update($request->all());

            return $student;
            DB::commit();
            return $this->sendResponse($student, 'Student updated successfully.', 204);
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Student::find($id)->delete();

            DB::commit();
            return $this->sendResponse("", 'Student deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }
}
