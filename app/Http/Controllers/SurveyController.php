<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Survey;

class SurveyController extends Controller
{
    public function create()
    {
        return view('survey.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $survey = Survey::where(['email' => $request->input('email')])->first();
        if (!$survey) {
            $survey = new Survey;
            $survey->email = $request->input('email');
            $survey->save();
        }

        $request->session()->put('survey_id', $survey->id);

        return redirect('/survey/step/1');
    }

    public function step(Request $request, $step)
    {
        dd($step);
    }
}
