<!-- User Id Field -->
{{-- <div class="form-group col-sm-12" style="text-align: center;">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Image Field -->
{{-- <div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div> --}}
<div class="form-group">
  <label for="myId" class="col-md-1 control-label">{{ trans('general.image_upload') }}</label>
  <div class="col-md-11">
    <div class="dropzone" id="myId" item_id=""></div>
  </div>
</div>

<!-- Status Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align: center; margin-top: 10px;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('images.index') }}" class="btn btn-default">Cancel</a>
</div>
