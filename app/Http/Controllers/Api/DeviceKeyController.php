<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceKey;
use Exception;
use Illuminate\Http\Request;

class DeviceKeyController extends Controller
{
    public function save(Request $request)
    {
        try {
            $data = $request->validate([
                'fcm_key' => 'string',
                'user_id' => 'integer',
            ]);

            DeviceKey::create([
                'fcm_key' => $data['fcm_key'],
                'user_id' => $data['user_id'],
            ]);

            return response()->json([
                'message' => 'Device key saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}