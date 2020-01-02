@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Git User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($gitUser, ['route' => ['gitUsers.update', $gitUser->id], 'method' => 'patch']) !!}

                        @include('git_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection