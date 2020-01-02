@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Link
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($link, ['route' => ['links.update', $link->id], 'method' => 'patch']) !!}

                        @include('links.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection