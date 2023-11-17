<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserCtrl extends Controller {

    public function showForm() {
        return view('user');
    }

    public function store(Request $request) {

        try {
            $this->validate($request, [
                'name' => 'required',
                'surname' => 'required',
                'status' => 'required',
                'email' => 'required',
                'password' => 'required',
                'numbers' => 'required'

            ]);
        } catch (ValidationException $e) {
            echo $e->getMessage();
        }

        User::create(array('name'=> $request->nom, 'surname' => $request->prenom,'status' => $request->role, 'email' => $request->email, 'password' => $request->mdp,'numbers'=> $request->num,  ));

        //auth()->login($user);

        return back();
    }

}
