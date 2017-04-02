  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Driver</h4>
                            </div>
                            <div class="content">

       {!! Form::model($driver = new \App\Driver, ['url' => 'drivers', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                {!! csrf_field() !!}


    @include('drivers.form')

            
    {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection