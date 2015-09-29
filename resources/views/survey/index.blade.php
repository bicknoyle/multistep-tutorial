<h1>Welcome to My Survey</h1>

@include('errors.list')

{!! Form::open() !!}
    {!! Form::label('email', 'What is your email?') !!}<br>
    {!! Form::text('email') !!}<br>
    <button type="submit">Submit</button>
{!! Form::close() !!}