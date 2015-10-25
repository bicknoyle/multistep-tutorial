<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Survey;
use App\Question;

class SurveyController extends Controller
{
    public function __construct()
    {

        $this->middleware('survey', ['only' => ['getSurveyStep', 'postSurveyStep']]);
    }

    public function getSurvey()
    {
        return view('survey.index');
    }

    public function postSurvey(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $survey = Survey::firstOrNew(['email' => $request->input('email')]);
        if (!$survey->exists) {
            $survey->current_step = 1;
            $survey->save();
        }

        $request->session()->put('survey_id', $survey->id);

        return redirect()->action('SurveyController@getSurveyStep', ['step' => $survey->current_step]);
    }

    public function getSurveyStep(Request $request, $step)
    {
        $questions = $this->fetchStepQuestions($step);

        return view('survey.step')->with([
            'questions' => $questions,
            'step' => $step,
            'survey' => $request->survey
        ]);
    }

    public function postSurveyStep(Request $request, $step)
    {
        $questions = $this->fetchStepQuestions($step);

        $rules = [];
        foreach ($questions as $question) {
            $rules[$question->name] = $question->rule;
        }

        $this->validate($request, $rules);

        $request->survey->fill($request->only(array_keys($rules)));
        if ($request->survey->current_step == $step) {
            $request->survey->current_step++;
        }
        $request->survey->save();

        if ($request->survey->current_step > $request->maxStep) {
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
        if (!$questions->count()) {
            abort(404);
        }

        return $questions;
    }
}
