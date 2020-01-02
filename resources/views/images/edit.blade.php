@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Image
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($image, ['route' => ['images.update', $image->id], 'enctype' => 'multipart/form-data', 'method' => 'patch']) !!}

                        @include('images.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/bootstrap-fileupload.js') }}"></script>
@endsection