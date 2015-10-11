<h1>Step {{ $step }}</h1>

@include('errors.list')

{!! Form::model($survey) !!}
    @foreach($questions as $question)
        @if('radio' == $question->type)
            {{ $question->text }}<br>
            @foreach($question->values as $value)
                <label>{!! Form::radio($question->name, $value) !!} {{ $value }}</label><br>
            @endforeach
        @else
            {!! Form::label($question->name, $question->text) !!}<br>
            {!! Form::text($question->name) !!}<br>
        @endif
        <br>
    @endforeach
    <button type="submit">Submit</button>
{!! Form::close() !!}