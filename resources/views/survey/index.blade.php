{!! Form::open(['url' => 'survey']) !!}
    {!! Form::label('email', 'What is your email?') !!}<br>
    {!! Form::text('email') !!}<br>
    <button type="submit">Submit</button>
{!! Form::close() !!}