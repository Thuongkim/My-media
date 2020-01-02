<!-- Link Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::textarea('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="text-center form-group col-sm-12">
    {!! trans('general.active') !!}
    @if(isset($link->status))
    {!! Form::checkbox('status', 1, old('status', $link->status), [ 'class' => 'minimal-red' ]) !!}
    @else
    {!! Form::checkbox('status', 1, true, [ 'class' => 'minimal-red' ]) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('links.index') }}" class="btn btn-default">Cancel</a>
</div>
