<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
		.report-table {
		    border-collapse: collapse;
		    width: 100%;
		    font-weight: 300;
		    margin-bottom: 10px;
		    font-size: 85%;
		}

		.report-table tr th, .report-table tr td {
		    text-align: left;
		    padding: 8px;
		      font-weight: 300;
		        border: 1px solid #ddd;
    text-align: center;
		}

		.report-table tr:nth-child(even){background-color: #f2f2f2}

		.report-table tr th {
		    background-color: #2c3e50;
		    color: white;
		}

    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 800px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 800px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'width:800px; margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="{{ $style['email-wrapper'] }}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="{{ $style['email-masthead'] }}">
                         		  <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="">
                         		RFID TRUCKING MONITORING REPORT
                         		</a>

                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td style="{{ $style['email-body'] }}" width="100%">
                            <table style="{{ $style['email-body_inner'] }}" align="center" width="800" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                        <!-- Greeting -->
                                        <h1 style="{{ $style['header-1'] }}">
                                           Good day!
                                        </h1>

                                        <!-- Intro -->
                                      
                                            <p style="{{ $style['paragraph'] }}">
                                                Kindly see the table below for today's trucking monitoring status report to this day.
                                            </p>
                                          
                            <table class="report-table" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">
                                            <span style="font-size: 15px; text-transform: uppercase">
                                                <strong>
                                             Truck Entries Today
                                                </strong>
                                            </span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver Name</th>
                                        <th>Plate Number</th>
                                        <th>Operator</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>Time between</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1; ?>
                                @foreach($logs as $result)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            @foreach($result->drivers as $driver)
                                                    {{  $driver->name }}
                                            @endforeach  
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                        @endforeach                                         
                                        
                                        </td>   


                                        
                                        <td>
                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in)
                                            <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                        @empty
                                            NO IN
                                        @endforelse     
                                          
                                        </td>   
                                             
                                        <td>
                                        <?php $final_out = ''; ?>                                     
                                        @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out)
                                                    <span class="label label-warning">{{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                        @empty
                                        NO OUT
                                        @endforelse   
                                        </td> 
                                       
                                        <td>

                                         @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out )
                                         	@forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in )
                                       			{{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
                                       		@empty
                                       			NO PAIRED TIME IN
                                       		@endforelse
                                         @empty
			                                  NO PAIRED TIME OUT
                                         @endforelse                                     
                                           
                                        </td>      
                                    </tr>                        
                                @endforeach  


                                </tbody>
                            </table>




                             <table class="report-table" width="100%" style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            <span style="font-size: 15px; text-transform: uppercase">
                                                <strong>
                                            Trucks Currently in plant
                                                </strong>
                                            </span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver Name</th>
                                        <th>Plate Number</th>
                                        <th>Operator</th>
                                        <th>Plant in</th>
                                        <th>Idle Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                
                                     <?php $ii = 1; ?>
                                    @foreach($total_in as $today)
                                      @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                             

                                      @empty
                                    <tr class="">
                                        <td>
                                        {{$ii++}}
                                        </td>
                                        <td>
                                            @foreach($today->drivers as $driver)
                                                    {{  $driver->name }}
                                            @endforeach 
                                        </td>
                                        <td>
                                          @foreach($today->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>  
                                        <td>
                                        @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach 
                                        </td>  
                                        <td>

                                        <span class="label label-success">{{  date('Y-m-d h:i:s A', strtotime($today->LocalTime))}} </span><br/>
                                        
                                        </td> 

                                        <td>

                                        {{  $today->LocalTime->diffInHours(Carbon\Carbon::now('Asia/Manila'))  }} Hour(s)

                                        </td>                               
                                    </tr>    


                                    @endforelse                            
                                    @endforeach                            
                                </tbody>
                            </table>
 






                                       
                                    

                                        <!-- Salutation -->
                                        <p style="{{ $style['paragraph'] }}">
                                            Regards,<br>Trucking Monitoring
                                        </p>

                                        <!-- Sub Copy -->
                                       
                                            <table style="{{ $style['body_sub'] }}">
                                                <tr>
                                                    <td style="{{ $fontFamily }}">
                                                        <p style="{{ $style['paragraph-sub'] }}">
                                                           This is a auto generate email, If you’re having trouble contact the administrator.
                                                         </p>
                                                    
                                                    </td>
                                                </tr>
                                            </table>
                                       
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <table style="{{ $style['email-footer'] }}" align="center" width="800" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                        <p style="{{ $style['paragraph-sub'] }}">
                                            &copy; {{ date('Y') }}
                                            All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
