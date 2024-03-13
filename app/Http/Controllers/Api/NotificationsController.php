<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public static function notify($title, $body, $device_key)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = env('FIREBASE_SERVER_KEY', 'sync');

        $data = [
            'to' => $device_key,
            'priority' => 'high',
            'data' => [
                'title' => $title,
                'body' => $body,
                'content' => [
                    'priority' => 'high',
                    'status' => 'done',
                    'id' => 100,
                    'channelKey' => 'high_importance_channel',
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.$serverKey,
            ],
        ]);

        $response = $client->post($url, [
            'body' => json_encode($data),
        ]);

        return $response->getBody()->getContents();
    }

    public function notifyUser(Request $request)
    {
        $title = $request->title;
        $body = $request->body;
        $device_key = $request->device_key;

        $response = self::notify($title, $body, $device_key);

        return response()->json([
            'response' => $response,
        ]);
    }

    public function notifyOrderComplete(Order $order)
    {
        $title = 'Order Complete';
        $body = 'Your order has been completed';

        $device_key = $order->buyer->user->nom;
        dd($device_key);

        if ($order->status == 'completed') {
            $response = self::notify($title, $body, $device_key);

            return response()->json([
                'response' => $response,
            ]);
        } else {
            return response()->json([
                'response' => 'Order not completed',
            ]);
        }
    }
}
