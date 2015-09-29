<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Survey;

class SurveyController extends Controller
{
    protected $lastStep = 3;

    public function getSurvey()
    {
        return view('survey.index');
    }

    public function postSurvey(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $survey = Survey::firstOrCreate(['email' => $request->input('email')]);
        $request->session()->put('survey', $survey);

        return redirect()->action('SurveyController@getSurveyStep', ['step' => 1]);
    }

    public function getSurveyStep(Request $request, $step)
    {
        return view('survey.step_'.$step, ['survey' => $request->session()->get('survey')]);
    }

    public function postSurveyStep(Request $request, $step)
    {
        switch ($step)
        {
            case 1:
                $rules = ['name' => 'required|min:2|max:50'];
                break;
            case 2:
                $rules = ['color' => 'required|min:3'];
                break;
            case 3:
                $rules = ['pet' => 'required|in:Cats,Dogs'];
                break;
            default:
                abort(400, "No rules for this step!");
        }

        $this->validate($request, $rules);

        $request->session()->get('survey')
            ->update($request->all())
        ;

        if ($step == $this->lastStep) {
            return redirect()->action('SurveyController@getSurveyDone');
        }

        return redirect()->action('SurveyController@getSurveyStep', ['step' => $step+1]);
    }

    public function getSurveyDone()
    {
        return '<h1>Thanks! You have completed the survey</h1>';
    }
}
