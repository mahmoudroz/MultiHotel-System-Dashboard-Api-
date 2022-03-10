<?php
namespace App\Http\Traits;

use App\Models\Employee;
use App\Models\Guest;
use App\Models\Notification;
use App\Models\Supervisor;
use Kutia\Larafirebase\Facades\Larafirebase;

trait NotificationTrait{

 public function sendNotification($title_ar='HTask',$title_en='Htask',$body_ar,$body_en,$reciver_id,$order_id=null,$type=null)
    {
        Notification::create([
            'ar'            =>['title'=>$title_ar,'body'=>$body_ar],
            'en'            =>['title'=>$title_en,'body'=>$body_en],
            'type'          =>$type,
            'order_id'          =>$order_id,
            'reciver_id'    =>$reciver_id,
        ]);

        if($type=='emp'){
            $reciver=Employee::find($reciver_id);
        }
        elseif($type=='sup'){
            $reciver=Supervisor::find($reciver_id);
        }
        else{
            $reciver=Guest::find($reciver_id);
        }

        if($reciver->mobile_token != null)
        {
            Larafirebase::withTitle($title_en)
                        ->withBody($body_en)
                        ->withPriority('high')
                        ->withAdditionalData([
                                'order_id'      =>  $order_id      ?? null,
                                ])
                        ->sendNotification($reciver->mobile_token);
             Larafirebase::fromRaw([
                'registration_ids' => [$reciver->mobile_token],
                'data' => [
                        'title'         =>  $title_en,
                        'body'          =>  $body_en,
                        'data' =>[
                                'order_id'      =>  $order_id      ?? null,
                                ],
                        ],
                'android' => [
                    'ttl' => '1000s',
                    'priority' => 'high',
                    'notifications' => [
                        'title'         =>  $title_en,
                        'body'          =>  $body_en,
                        'order_id'      =>  $order_id      ?? null,
                    ],
                ],
            ])->send();

        }

    }
}
