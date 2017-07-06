  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Add Pickup</p>
                            </div>
                            <div class="panel-body">

                            {!! Form::model($pickup = new \App\Pickup, ['url' => 'pickups', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                                        {!! csrf_field() !!}
                            @include('pickups.form')
                            {!! Form::close() !!}
                            
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection