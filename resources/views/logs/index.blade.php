@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">System Logs</h4>
                                <p class="category">Logs and activies within the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Date/Time</th>
                                        <th>Summary</th>
                                    </thead>
                                    <tbody>


                                    {{ $revisions->count() }}




                                    </tbody>
                                </table>




                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection
