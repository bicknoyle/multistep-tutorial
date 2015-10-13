<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Survey;
use App\Question;

class SurveyController extends Controller
{
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
        $questions = $this->fetchStepQuestions($step);

        return view('survey.step')->with([
            'questions' => $questions,
            'step' => $step,
            'survey' => $request->session()->get('survey')
        ]);
    }

    public function postSurveyStep(Request $request, $step)
    {
        $questions = $this->fetchStepQuestions($step);
        $lastStep = Question::max('step');

        $rules = [];
        foreach ($questions as $question) {
            $rules[$question->name] = $question->rule;
        }

        $this->validate($request, $rules);

        $request->session()->get('survey')
            ->update($request->only(array_keys($rules)))
        ;

        if ($step == $lastStep) {
            return redirect()->action('SurveyController@getSurveyDone');
        }

        return redirect()->action('SurveyController@getSurveyStep', ['step' => $step+1]);
    }

    public function getSurveyDone()
    {
        return '<h1>Thanks! You have completed the survey</h1>';
    }

    protected function fetchStepQuestions($step)
    {
        $questions = Question::where('step', $step)->get();
        if (empty($questions)) {
            abort(404);
        }

        return $questions;
    }
}
