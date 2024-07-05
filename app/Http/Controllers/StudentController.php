<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        return view('studentDetails', [
            'students' => $students
        ]);

    }


    public function addStudent(Request $request){

        $name = $request->name;
        // echo $request->mark;
        $subject = $request->subject;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mark' => 'required|integer|min:0|max:100',
        ]);       

            $checksql = DB::table('students')->where('name', $name)->where('subject', $subject)->first();

            if($checksql){
                return redirect()->back()->with('fail', 'Student record all ready submited');
            }
            Student::create($validatedData);
            
            return redirect()->back()->with('success', 'Student record Add successfully.');
        
    }

    public function deleteData(Request $request){
       $id = $request->id;
    //    die();

        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with('success', 'Student record delete successfully.');
    }



    public function updateData(Request $request){
      $id = $request->id;
     //    die();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mark' => 'required|integer|min:0|max:100',
        ]);

       $stud = Student::findOrFail($id);
        $updaterecode = $stud->update($validatedData);

        if($updaterecode){
            return redirect()->back()->with('success', 'Student record Updated successfully.');

        }else{
        return redirect()->back()->with('fail', 'Student record not Updated.');

        }
  
     }


     public function getStudentData($id)
    {
        
        
        try {
            $student = Student::findOrFail($id);

            // Log the student data fetched
            Log::info('Fetching student data for ID: ' . $student->toJson());

            // Optionally, you can return the student data directly
            return response()->json($student);
        } catch (\Exception $e) {
            Log::error('Error fetching student data: ' . $e->getMessage());
            return response()->json(['error' => 'Student not found.'], 404);
        }
    }
}
