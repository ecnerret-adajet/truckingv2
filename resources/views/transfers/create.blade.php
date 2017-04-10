  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Re-assign Truck</h4>
                            </div>
                            <div class="content">

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