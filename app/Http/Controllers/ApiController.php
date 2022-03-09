<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllStudents() {
        // Display every student
        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);

      }

      public function createStudent(Request $request) {
        // creating student logic
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "Student Record Created Succesfully"
        ], 201);
      }

      public function getStudent($id) {
        // getting a student from list
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Oops Student Data Not Found"
            ], 404);
          }

      }

      public function updateStudent(Request $request, $id) {

        // $request->validate([
        //     'name' => 'required',
        //     'course' => 'required',
        // ]);
        $student = Student::find($id);
        $student->name = $request->name;
        $student->course = $request->course;
        $result = $student->save();

        if($result)
            {
            return response()->json(["message" => "Update Successfull"], 200);
            }
            else {
                    return response()->json(["message" => "Student Record Not Found"], 404);
                }
      }

      public function deleteStudent ($id) {
        // delete student
        if(Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();

            return response()->json([
              "message" => "Student Data Deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Student Record(s) Not Found"
            ], 404);
          }
        }

        public function search($name)
        {
            // return Student::where('name','like','%'.$name.'%')->get();
            if (Student::where('name', $name)->exists()) {
                $student = Student::where('name','like','%'.$name.'%')->get()->toJson(JSON_PRETTY_PRINT);
                return response($student, 200);
              } else {
                return response()->json([
                  "message" => "Oops Student Data Not Found"
                ], 404);
              }

        }
}
