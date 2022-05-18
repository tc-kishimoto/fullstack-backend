<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getNotification(Request $request)
    {
        $result = Notification::where('target_user_id', '=', $request->user()->id)
        // ->where('status', '=', 0)
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();
        return response($result, 200);
    }

    public function updateNotificationStatus(Request $request)
    {
        Notification::where('target_user_id', $request->user()->id)
        ->where('status', 0)
        ->update(['status' => 1]);
        return response([], 200);
    }
}
