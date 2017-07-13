  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Edit Pickup Entry</p>
                            </div>
                            <div class="panel-body">

                                {!! Form::model($pickup, ['method' => 'PATCH','route' => ['pickups.update', $pickup->id], 'enctype'=>'multipart/form-data']) !!}
                                {!! csrf_field() !!}


                                @include('pickups.form')

                                        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection