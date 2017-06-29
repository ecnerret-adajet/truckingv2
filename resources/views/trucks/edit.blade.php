  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Edit Truck</p>
                            </div>
                            <div class="panel-body">

                                {!! Form::model($truck, ['method' => 'PATCH','route' => ['trucks.update', $truck->id], 'enctype'=>'multipart/form-data']) !!}
                                {!! csrf_field() !!}


                                @include('trucks.form')

                                        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection