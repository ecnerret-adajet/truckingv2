  @extends('layouts.app')
@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p>Edit Hauler</p>
                            </div>
                            <div class="panel-body">

                                {!! Form::model($hauler, ['method' => 'PATCH','route' => ['haulers.update', $hauler->id], 'enctype'=>'multipart/form-data']) !!}
                                {!! csrf_field() !!}


                                @include('haulers.form')

                                        
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection