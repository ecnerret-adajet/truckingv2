@extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Add hauler</p>
                            </div>
                            <div class="panel-body">

                            {!! Form::model($hauler = new \App\Hauler, ['url' => 'haulers', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                                        {!! csrf_field() !!}


                            @include('haulers.form')

                                    
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection