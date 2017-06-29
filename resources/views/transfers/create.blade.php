  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Re-assign Truck</p>
                            </div>
                            <div class="panel-body">

                                {!! Form::model($transfer = new \App\Transfer, ['url' => 'transfers/'.$driver->id, 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                                    {!! csrf_field() !!}


                                @include('transfers.form')

                                        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection