<h1>Step 2</h1>

@include('errors.list')

{!! Form::model($survey) !!}
    {!! Form::label('color', 'What is your favorite color?') !!}<br>
    {!! Form::text('color') !!}<br>
    <button type="submit">Submit</button>
{!! Form::close() !!}