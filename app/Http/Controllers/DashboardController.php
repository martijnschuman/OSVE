<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\ExamenMoment;
use App\Models\User;
use App\Models\Opleidingen;
use App\Models\GeplandeExamens;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();
        $examens = Examen::all();

        foreach($examens as $examen){
            foreach($users as $user){
                if($examen->geplande_docenten == $user->email){
                    $examen->geplande_docenten = $user->voornaam . " " . $user->achternaam;
                }
            }
        }

        $opleidingen = Opleidingen::all();
        $geplandeExamens = GeplandeExamens::all();

        //Tijdelijk tot de relatie erin zit
        foreach($geplandeExamens as $geplandExamen){
            $examen = Examen::where('id', $geplandExamen->examen)->first();
            $examenMoment = ExamenMoment::where('id', $geplandExamen->examen_moment)->first();

            $geplandExamen->gepland_examen = $examen->examen;
            $geplandExamen->datum = $examenMoment->datum;
            $geplandExamen->tijd = $examenMoment->tijd;
        }

        return view('dashboard.index')
            ->with(compact('examens'))
            ->with(compact('opleidingen'))
            ->with(compact('geplandeExamens'));
    }

}