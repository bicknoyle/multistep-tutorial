<h1>Step 3</h1>

@include('errors.list')

{!! Form::model($survey) !!}
    Which type of pet is best?<br>
    <label>{!! Form::radio('pet', 'Cats') !!} Cats</label><br>
    <label>{!! Form::radio('pet', 'Dogs') !!} Dogs</label><br>
    <label>{!! Form::radio('pet', 'Lizards') !!} Lizards</label><br>
    <button type="submit">Submit</button>
{!! Form::close() !!}