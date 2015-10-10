<h1>Step {{ $step }}</h1>

@include('errors.list')

{!! Form::model($survey) !!}
    @foreach($questions as $question)
    	@include($question->template)
    	<br>
    @endforeach
    <button type="submit">Submit</button>
{!! Form::close() !!}