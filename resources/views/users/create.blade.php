  @extends('layouts.app')

@section('content')

           <div class="container-fluid">
            <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add New User</h4>
                            </div>
                            <div class="content">


      {!! Form::model($user = new \App\User, [ 'url' => 'users', 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                {!! csrf_field() !!}

    @include('users.form')

            
     {!! Form::close() !!}
                            </div>
                        </div>
                    </div>




                </div><!-- end row -->
            </div>


@endsection