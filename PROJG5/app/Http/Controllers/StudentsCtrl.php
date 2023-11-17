<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;


class StudentsCtrl extends Controller
{

    public function listAll(Request $request)
    {
        $student_list = Student::paginate(15);

        return view('students', ['student_list' => $student_list]);
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->numbers = $request->numbers;
        $student->last_name = $request->last_name;
        $student->first_name = $request->first_name;
        $student->save();
    }

    /**
     * This function receved a json file and add to Database.
     */
    public function importEtudiant(Request $request)
    {
        if ($request->file("filename") == null) {
            return back()->with('error', "Erreur : aucun fichier n'a été envoyé.");
        }
        $request->filename->storeAs('student', 'student.json');
        $file = File::get(storage_path('app/student/student.json'));
        $json = json_decode($file, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            try {
                $student = $json['students'];
                foreach ($student as $etu) {
                    Student::updateOrInsert(array('numbers' => $etu['number'], 'first_name' => $etu['first_name'], 'last_name' => $etu['last_name']));
                }
                return back()->with('sucess', "fichier bien importé.");;
            } catch (\Exception $e) {

                return back()->with('error', "Le fichier n'est pas correctement formaté.");
            }
        } else {
            return back()->with('error', "Le fichier n'est pas au format .json");
        }
    }

    function search(Request $request)
    {
        $q  = $request->input('q');
        $user = Student::where('numbers', 'LIKE', '%' . $q . '%')->orWhere('first_name', 'LIKE', '%' . $q . '%')->orWhere('last_name', 'LIKE', '%' . $q . '%')->paginate(15);
        $user->appends(array(
            'q' => $request->input('q')
        ));
        if (count($user) > 0) {
            return view('students', ['student_list' => $user]);
        } else return back()->with('error', "Erreur : pas de résultats trouvés (" . $q.").");
    }
}
