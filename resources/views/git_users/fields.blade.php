<!-- Git User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('git_user', 'Git User:') !!}
    {!! Form::text('git_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('gitUsers.index') }}" class="btn btn-default">Cancel</a>
</div>
