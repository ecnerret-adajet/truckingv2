  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Add Driver</p>
                            </div>
                            <div class="panel-body">

                                {!! Form::model($driver, ['method' => 'PATCH','route' => ['drivers.update', $driver->id], 'enctype'=>'multipart/form-data']) !!}
                                {!! csrf_field() !!}


                                @include('drivers.form')

                                        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection