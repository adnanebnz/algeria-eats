<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    static public function notify($title, $body, $device_key)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = env('FCM_SERVER_KEY', 'sync');
        $dataArray = [
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "status" => "done"
        ];
        $data = [
            "registration_ids" => [$device_key],
            "notification" => [
                "title" => $title,
                "body" => $body,
                "sound" => "default",
            ],
            "data" => $dataArray,
            "priority" => "high"
        ];
        $encodedDaya = json_encode($data);
        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $serverKey
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
    }
}
