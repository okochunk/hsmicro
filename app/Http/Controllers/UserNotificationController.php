<?php

namespace App\Http\Controllers;

use App\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_notifications = UserNotification::getAllNotification($request)->paginate(config('pagination.admin.per_page'));

        return view('admin/user_notifications/index', compact('user_notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_notification = new UserNotification();

        return view('admin/user_notifications/create', compact('user_notification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'description' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
            'is_active'   => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_notifications.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            UserNotification::storeNotification($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $notification = [
            'message' => 'User Notification created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('user_notifications.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserNotification  $userNotification
     * @return \Illuminate\Http\Response
     */
    public function show(UserNotification $userNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserNotification  $userNotification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_notification = UserNotification::find($id);

        return view('admin/user_notifications/edit', compact('user_notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserNotification  $userNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'description' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
            'is_active'   => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_notifications.edit', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $user_notification              = UserNotification::find($id);
        $user_notification->title       = $request->get('title');
        $user_notification->description = $request->get('description');
        $user_notification->is_active   = $request->get('is_active');
        $user_notification->start_date  = $request->get('start_date');
        $user_notification->end_date    = $request->get('end_date');
        $user_notification->save();

        $notification = [
            'message'    => 'User Notification updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('user_notifications.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserNotification  $userNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_notification = UserNotification::find($id);
        $user_notification->delete();

        $notification = [
            'message' => 'User Notification deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('user_notifications.index')->with($notification);
    }
}
