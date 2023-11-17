<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\Controller;
use App\Prerequis;
use App\Report;
use App\StudentGroup;
use App\UE;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class ReportsCtrl extends Controller
{

    public function listAll()
    {
        $reports_list = DB::table('report')->select('numbers')->groupBy('numbers')->paginate(15);
        return view('reports', ['reports_list' => $reports_list]);
    }

    public function search (Request $request) {
        $q = $request->input('q');
        $reports_list =  DB::table('report')->select('numbers')->where ( 'numbers', 'LIKE', '%' . $q . '%' )->groupBy('numbers')->paginate(15);
        $pagination = $reports_list->appends ( array (
            'q' => $request->input('q')
          ) );
        if (count($reports_list) > 0){
        return view('reports', ['reports_list' => $reports_list]);
        }
        else return back()->withError("Aucun élève ne correspond");
       }

    /**
     * This function receives a json file containing the student's reports.
     */
    public function importBulletin(Request $request){

        if($request->file("filename")==null){
            return back()->with('error',"Erreur : aucun fichier n'a été envoyé.");
        }

        $request->filename->storeAs('student','reports.json');
        $file = File::get(storage_path('app/student/reports.json'));
        $json = json_decode($file, true);

        $missing_student_message = "Les étudiants suivants n'ont pas pu être ajoutés (inexistants dans la BDD) : ";
        $missing_student = false;

        // Vérifier si on a bien envoyé un fichier .json décodable
        if(json_last_error() === JSON_ERROR_NONE){

            $student_report = $json['students'];
            foreach($student_report as $report){

                try{
                    $number = $report['numbers'];
                    foreach($report['bulletin'] as $report_data) {
                        Report::updateOrInsert(['numbers'=>$number, 'UE' => $report_data['UE']],['acquired'  => $report_data['acquired']]);
                    }
                }catch(\Exception $exception){
                    // Erreur de structure
                    if($exception->getCode()==0){
                        return back()->with('error', "Erreur : la structure du fichier ne correspond pas à un bulletin.");
                    }
                    // ID pas dans la table étudiant.
                    if($exception->getCode()==23000){
                        $missing_student = true;
                        $missing_student_message .= $number.", ";
                    }
                }
            }

            if(!$missing_student){
                return back()->with('success', "Ajout/mise à jour des bulletins réussie.");
            } else{
                return back()->with('error', $missing_student_message);
            }

        }else{
            return back()->with('error', "Erreur : le fichier n'a pas pu être décodé (mauvais format).");
        }
    }

    /**
     * Resets the list of reports
     */
    public function resetList(){
        Report::truncate();
        return back()->with('success', "Les bulletins ont été supprimés.");
    }

    /**
     * This function sort the student of the report in a group depending on their report
     */
    public function sortStudent(){
        $data = Report::all();
        $currentStudentNumbers = 0;
        $successArray = array();
        $failureArray = array();
        foreach($data as $report){
            $previousStudentNumbers = $currentStudentNumbers;
            $currentStudentNumbers = $report->numbers;
            if($previousStudentNumbers == $currentStudentNumbers){
                if($report->acquired){
                    array_push($successArray,$report->UE);
                } else {
                    array_push($failureArray, $report->UE);
                }
            } else {
                $blocStudent = $this->blocStudent($successArray,$failureArray,$previousStudentNumbers);
                array_splice($successArray,0);
                array_splice($failureArray,0);
                if($report->acquired){
                    array_push($successArray,$report->UE);
                } else {
                    array_push($failureArray, $report->UE);
                }
            }
        }
        $blocStudent = $this->blocStudent($successArray,$failureArray, $currentStudentNumbers);

    }


    private function blocStudent($successArray, $failureArray, $studentNumber){
        if((count($successArray) == 0) && (count($failureArray) == 0)){
            return 0;
        }
        $etcsBloc1 = 0;
        foreach ($successArray as $course){
            switch(filter_var($course,FILTER_SANITIZE_NUMBER_INT)){
                case 1:
                case 2:
                    $etcsBloc1 = $etcsBloc1 + (UE::query()->find($course,'ECTS'))["ECTS"];
                    break;
            }
        }
        if($etcsBloc1 >= 45){
            $etcsThisYear = $this->countEctsArray($failureArray);
            $possibleCourse = $this->possibleCourse($successArray);
            // TODO Regarder si l'étudiant a les corequis de ETE6
            $foundEte = false;
            for($i = 0; $i < count($possibleCourse) && !$foundEte; $i++){
                if($possibleCourse[$i] == "ETE6"){
                    $foundEte = true;
                }
            }
            // nouvelle liste (compteur + liste)
            while($etcsThisYear < 60){
                for($i = 0; $i < count($possibleCourse) && $etcsThisYear < 60; $i++) {
                    array_push($failureArray, $possibleCourse[$i]);
                    $etcsThisYear = $this->countEctsArray($failureArray);
                    if ($etcsThisYear > 60) {
                        array_pop($failureArray);
                    }
                }
            }
            if($foundEte){
                // ajouter dans les groupes de 3e
                $group = Group::query()->where('group','like','E%')->get();
                StudentGroup::firstOrCreate(array());
                return 3;
            } else {
                // ajouter dans les groupes de 2e
                $group = Group::query()->where('group','like','C%')->get();
                $group = $group->toArray();
                var_dump($studentNumber);
                StudentGroup::firstOrCreate(array('group_id' => $group[array_rand($group)]["group"], 'number_id' => $studentNumber));
                return 2;
            }
        } else {
            // ne rien faire
            return 1;
        }
    }

    private function countEctsArray($failureArray){
        $ects = 0;
        foreach ($failureArray as $course){
            $ects = $ects + UE::query()->find($course,'ECTS')['ECTS'];
        }
        return $ects;
    }

    private function possibleCourse($successArray)
    {
        $data = UE::all();
        $returned = array();
        foreach ($data as $UE) {
            if (Prerequis::where('UE_ID', '=', $UE->UE)->exists()) {
                $foundPrerequis = true;
                $pre_requis = Prerequis::query()->where('UE_ID','=',$UE->UE)->get();
                for($j = 0 ; $j< count($pre_requis) && $foundPrerequis;$j++) {
                    $foundSuccess = false;
                    for ($i = 0; $i < count($successArray) && !$foundSuccess; $i++) {
                        if($pre_requis[$j]->prerequis == $successArray[$i]){
                            $foundSuccess = true;
                        }
                    }
                    if(!$foundSuccess){
                        $foundPrerequis = false;
                    }
                }
                if($foundPrerequis){
                    array_push($returned, $UE->UE);
                }
            } else {
                array_push($returned, $UE->UE);
            }
        }
        return $returned;
    }
}
