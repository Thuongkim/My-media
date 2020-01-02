@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Text
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($text, ['route' => ['texts.update', $text->id], 'method' => 'patch']) !!}

                        @include('texts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection