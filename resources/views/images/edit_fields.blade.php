<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-preview thumbnail" style="min-height: 300px; max-height: auto; max-width: 500px;">
            @if($image->image)
            <img src="{!! asset($image->image) !!}">
            @endif
        </div>
        <div>
            <span class="btn btn-default btn-file">
                <span class="fileupload-new">
                    {!! trans('general.select_image') !!}
                </span>
                {!! Form::file('image') !!}
            </span>
            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">
                {!! trans('general.remove') !!}
            </a>
            (Kích thước 500x300)
        </div>
    </div>
</div>

<div class="text-center form-group col-sm-12">
    {!! trans('general.active') !!}
    {!! Form::checkbox('status', 1, old('status', $image->status), [ 'class' => 'minimal-red' ]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align: center; margin-top: 10px;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('images.index') }}" class="btn btn-default">Cancel</a>
</div>
