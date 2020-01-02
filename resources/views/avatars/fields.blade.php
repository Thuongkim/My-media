<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-preview thumbnail" style="min-height: 500px; max-height: auto; max-width: 1000px;">
            @if(isset($avatar->image))
            <img src="{!! asset($avatar->image) !!}">
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
            (Kích thước 1000x500)
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('avatars.index') }}" class="btn btn-default">Cancel</a>
</div>
