<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationCenterController extends Controller
{
    public function store(Request $request)
    {
        $notification = Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json([
            'success' => true,
            'notification' => $notification
        ]);
    }

    public function index(Request $request)
    {

        $filter = $request->query('filter', 'all');
        $query = Notification::where('user_id', Auth::id());

        if ($filter === 'unread') {
            $query->where('is_read', false);
        }

        $notifications = $query->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return view('partials.notifications', compact('notifications'))->render();
        }

        return view('notification-center', compact('notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}