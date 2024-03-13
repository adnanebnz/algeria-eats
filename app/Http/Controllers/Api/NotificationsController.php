<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    static public function notify(Request $request)
    {
        $device_key = $request->device_key;
        $body = $request->body;
        $title = $request->title;
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = env('FIREBASE_SERVER_KEY', 'sync');

        $data = [
            "to" => $device_key,
            "priority" => "high",
            "data" => [
                "title" => $title,
                "body" => $body,
                "content" => [
                    "priority" => "high",
                    "status" => "done",
                    "id" => 100,
                    "channelKey" => "high_importance_channel",
                    "title" => $title,
                    "body" => $body,
                ],
            ]
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . $serverKey
            ]
        ]);

        $response = $client->post($url, [
            'body' => json_encode($data)
        ]);

        return $response->getBody()->getContents();
    }
}
