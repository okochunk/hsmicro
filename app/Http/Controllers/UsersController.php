<?php

namespace App\Http\Controllers;

use App\Mail\UserUpdated;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RelationalExample\Model\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::getAllUser($request)->paginate(config('pagination.admin.per_page'));

        return view('admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin/users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'is_active'     => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $user                = User::find($id);
        $user->is_active     = $request->get('is_active');
        $user->save();

        $notification = [
            'message'    => 'User updated successfully!',
            'alert-type' => 'success'
        ];

        // mail to user when set to active
        if ($request->get('is_active')) {
            $when = Carbon::now()->addMinutes(1);
            Mail::to($user->email)->later($when, new UserUpdated($user));
        }


        return redirect()->route('users.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
