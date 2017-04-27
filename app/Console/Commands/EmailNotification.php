<?php

namespace App\Console\Commands;

use DB;
use Mail;
use Excel;
use App\Log;
use App\Card;
use App\Driver;
use App\Hauler;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends daily email report to admin';
    protected $log;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Log $log)
    {
        parent::__construct();
        $this->log = $log;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $logs = Log::where('CardholderID', '>=', 1)
                ->whereDate('LocalTime', Carbon::now())
                ->orderBy('LocalTime','DESC')->get();

        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime',  Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

        $all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime',   Carbon::now())
			->orderBy('LocalTime','DESC')->get();

         $today_log = $logs->unique('CardholderID');
         $total_in = $all_in_2->unique('CardholderID');

         $data = [
            'name' => 'Admin',
            'logs' => $today_log,
            'all_in' => $all_in,
            'all_out' => $all_out,
            'total_in' => $total_in,
         ];


        // Excel::create('tracks_export'.Carbon::now()->format('Ymdh'), function($excel) {

        //     $excel->sheet('Sheet1', function($sheet) {
        //         $tracks_exports = Track::latest('created_at')->where('created_at', '>=' ,Carbon::now()->subDays(1))->get();
        //         $count_track = $tracks_exports->count();

        //         $arr =array();
        //         foreach($tracks_exports as $tracks_export) {
        //             foreach($tracks_export->trucks as $truck){
        //                 $data =  array(
        //                     $truck->plate_no, 
        //                     $tracks_export->dispatch, 
        //                     $tracks_export->out_plant->format('Y-m-d h:i:s A')  == '-0001-11-30 12:00:00 AM' ? 'N/A' : $tracks_export->out_plant->format('h:i:s A'), 
        //                     $tracks_export->in_customer->format('Y-m-d h:i:s A')  == '-0001-11-30 12:00:00 AM' ? 'N/A' : $tracks_export->in_customer->format('h:i:s A'), 
        //                     $tracks_export->out_customer->format('Y-m-d h:i:s A')  == '-0001-11-30 12:00:00 AM' ? 'N/A' : $tracks_export->out_customer->format('h:i:s A'), 
        //                     $tracks_export->back_plant->format('Y-m-d h:i:s A')  == '-0001-11-30 12:00:00 AM' ? 'N/A' : $tracks_export->back_plant->format('h:i:s A'));
        //                 array_push($arr, $data);
        //             }
                    
        //         }

        //         //set the titles
        //         $sheet->fromArray($arr,null,'A1',false,false)
        //                 ->setBorder('A1:F'.$count_track,'thin')
        //                 ->prependRow(array(
        //                 'PLATE NUMBER', 'PLANT IN', 'PLANT OUT', 'CUSTOMER IN', 'CUSTOMER OUT',
        //                 'BACK PLANT'));
        //         $sheet->cells('A1:F1', function($cells) {
        //                  $cells->setBackground('#f1c40f'); 
        //         });

        //     });

        // })->store('xls', storage_path('email'));
    
        
         Mail::send('email.report', $data, function($message) {
         $message->to('tejada.terrence@gmail.com', 'Report Generate')
                //   ->cc('tejada.terrence@gmail.com', 'Report Generate')
                //   ->bcc('tejada.terrence@gmail.com', 'Report Generate')
                  ->subject('RFID TRUCKING MONITORING REPORT');
        //  $message->attach('C:\xampp\htdocs\trucking-monitoring\storage\email\tracks_export'.Carbon::now()->format('Ymdh').'.xls');
         $message->from('notifications-noreply@trucking.com','Admin From Trucking Monitoring');
        });    
    
    
    }
}
