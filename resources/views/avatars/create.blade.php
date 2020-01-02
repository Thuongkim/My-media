@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Avatar
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'avatars.store', 'enctype' => 'multipart/form-data']) !!}

                        @include('avatars.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/bootstrap-fileupload.js') }}"></script>
@endsection
