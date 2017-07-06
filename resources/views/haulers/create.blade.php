@extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
<<<<<<< HEAD
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Add hauler</p>
                            </div>
                            <div class="panel-body">

                            {!! Form::model($hauler = new \App\Hauler, ['url' => 'haulers', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                                        {!! csrf_field() !!}


                            @include('haulers.form')

                                    
                            {!! Form::close() !!}
=======
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add hauler</h4>
                            </div>
                            <div class="content">

       {!! Form::model($hauler = new \App\Hauler, ['url' => 'haulers', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                {!! csrf_field() !!}


    @include('haulers.form')

            
    {!! Form::close() !!}
>>>>>>> 3ded25330052a3decb8981857026cbf8cbb39074
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection