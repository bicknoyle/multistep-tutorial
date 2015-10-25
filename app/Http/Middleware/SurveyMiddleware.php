<?php

namespace App\Http\Middleware;

use App\Survey;
use App\Question;
use Closure;

class SurveyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->survey = Survey::find($request->session()->get('survey_id'))) {
            return redirect()->action('SurveyController@getSurvey');
        }

        $request->maxStep = Question::max('step');
        if ($request->survey->current_step > $request->maxStep)
        {
            return redirect()->action('SurveyController@getSurveyDone');
        }
        elseif ($request->route('step') > $request->survey->current_step)
        {
            return redirect()->action('SurveyController@getSurveyStep', ['step' => $request->survey->current_step]);
        }

        return $next($request);
    }
}
