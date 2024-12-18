<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationCenterController extends Controller
{
    public function index()
    {
        $notifications = [
            [
                'project' => 'Proyecto Muebles sala',
                'status' => 'se está empaquetando'
            ]
        ];

        return view('notification-center', compact('notifications'));
    }
}

