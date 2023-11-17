<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Report;
use InteractsWithViews;

class ReportTest extends TestCase
{
    use RefreshDatabase;


    // Problème : impossible de sauvegarder les données malgré une requête correcte.
    // Il faut chercher comment éviter cette histoire de constraint foreign key, alors que
    // l'ajout d'un bulletin se fait sans soucis directement via la BDD.
    // La requête directe ne fonctionne pas non plus, c'est probablement lié soit aux foreign keys, soit au
    // doubles clés primaires.

    /**
     * Envoi d'un fichier non json.
     */
    public function testSendNotJsonFile(){
        // Crée un faux disque pour le faux upload de fichier
        Storage::fake('reports');
        $response = $this->json('POST', '/reports', ['report' => UploadedFile::fake()->create('document.pdf', 100)]);
        Storage::disk('reports')->assertMissing('document.pdf');
    }

    /**
     * Envoi d'un fichier json mais avec les mauvais champs.
     */
    public function testSendJsonWrongFields(){
        $path = storage_path("testDummies/reports/wrong_fields.json");
        Storage::fake('reports');
        $response = $this->json('POST', '/reports', ['report' => $path]);

        // Statut d'erreur interne
        $this->assertEquals(500, $response->status());

        Storage::disk('reports')->assertMissing('wrong_fields.json');
    }

    /**
     * Vérifie si on peut ajouter une entrée avec l'attribut numbers de mauvais type.
     */
    public function testWrongContentID(){

        $report = new Report([
            'numbers' => 'A',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
           $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

       $this->assertDatabaseMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }


    /**
     * Vérifie si on peut ajouter une entrée avec l'attribut UE de mauvais type.
     */
    public function testWrongContentUE(){
        $report = new Report([
            'numbers' => '40028',
            'UE' => 21,
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Vérifie si on peut ajouter une entrée avec l'attribut acquired de mauvais type.
     */
    public function testWrongContentAcquired(){
        $report = new Report([
            'numbers' => '40028',
            'UE' => 'CAI1',
            'acquired' => "aaaa",
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Vérifie si on peut ajouter une entrée d'un étudiant non existant.
     */
    public function testStudentNonexistent(){
        $report = new Report([
            'numbers' => '0',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Vérifie si on peut ajouter une entrée d'une UE non existente.
     */
    public function testUENonexistent(){
        $report = new Report([
            'numbers' => '40028',
            'UE' => 'FR2',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Vérifie si on peut ajouter deux lignes identiques.
     */
    public function testTwoSameLines(){
        $report = new Report([
            'numbers' => '40028',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseHas('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Ajout classique à la BDD.
     */
    public function testDataBase(){
        $report = new Report([
            'numbers' => '40315',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseHas('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Vérification de la suppresion du dummy.
     */
    public function testDataBaseDummyDeleted(){
        $report = new Report([
            'numbers' => '40315',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseHas('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
        $report->delete();
        $this->assertDatabaseHasMissing('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
    }

    /**
     * Modification d'un attribut.
     */
    public function testDataBaseModified(){
        $report = new Report([
            'numbers' => '40315',
            'UE' => 'CAI1',
            'acquired' => false,
        ]);

        try{
            $report->save();
        }catch(\Illuminate\Database\QueryException $e){
            var_dump($e->errorInfo);
        }

        $this->assertDatabaseHas('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>$report->acquired]);
        $report->update(['acquired' => true]);
        $this->assertDatabaseHas('report', ['numbers'=>$report->numbers, 'UE'=>$report->UE,'acquired'=>1]);
    }

    /*
     * 1) Envoyer un fichier pas JSON
     * 2) Envoyer un fichier JSON mais pas avec les bons champs
     * 2 - bis) Tester individuellement les erreurs sur chaque champ
     * 3) Envoyer un fichier avec un étudiant non existant
     * 4) Envoyer un fichier avec une matière non existante
     * 5) Envoyer un fichier avec deux clés primaires identiques
     * 6) Tester que l'envoi à la BDD se soit bien passé
     * 7) Vérifier que le dummy soit bien supprimé
     * 8) Voir si la modification est fonctionnelle (cf. tests Student)
     *
     */

      /**
     * test the route and status
     */
    public function testCreateReportUrl() {
        $response = $this->get('/report');

        $response->assertStatus(200);
    }
     /**
     * test the route and status
     */
    public function testCreateReporstUrl() {
        $response = $this->get('/reports');

        $response->assertStatus(200);
    }

    public function testContent() {
        $response = $this->get('/report');
        $response->assertView()->contains('table');
        $response->assertView()->contains('th');
        $response->assertView()->contains('tr');
        
    }

    public function testContentReportView() {
        $response = $this->get('/reports');
        $response->assertView()->contains('h1');
        $response->assertView()->contains("Liste des bulletins");
        $response->assertView('button')->contains('Choisir un fichier');
        $response->assertView('button')->contains('Envoyer');
        $response->assertView()->contains('table');
        $response->assertView()->contains('th');
        $response->assertView()->contains('tr');
    }
}
