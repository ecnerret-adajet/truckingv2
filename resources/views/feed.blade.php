
@extends('layouts.app')

@section('top-script')

    <script>
        setInterval(
        function(){
            $('#terter').load('http://172.17.2.88/rfidtrucking/public/feed-body');
        }, 2000);
    </script>


@endsection

@section('content')

 
  <div class="main-panel">

        
                <div class="row">
                <!-- table  -->
                    <div class="col-md-12">

                                                        
                            <div id="terter">
                            </div>
                            
                          
                    </div>
                </div><!-- end row -->
           


    </div>



@endsection






