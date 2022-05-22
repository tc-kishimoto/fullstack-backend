<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function search(Request $request)
    {
        $result = Notification::where('target_user_id', $request->user()->id)
        ->orderByDesc('created_at')
        ->get();
        return response($result, 200);
    }
    public function getNotification(Request $request)
    {
        $notifications = Notification::where('target_user_id', '=', $request->user()->id)
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();

        $count = Notification::where('target_user_id', '=', $request->user()->id)
        ->where('status', '=', 0)
        ->count();
        return response([
            'notifications' => $notifications,
            'count' => $count,
        ], 200);
    }

    public function updateNotificationStatus(Request $request)
    {
        Notification::where('target_user_id', $request->user()->id)
        ->where('status', 0)
        ->update(['status' => 1]);
        return response([], 200);
    }
}
