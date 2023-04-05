<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{   

    public function showData($id)
    {
        // Get data from /users/id -- req 
        $user = User::findOrFail($id);

        $data = [
            'user' => $user,
        ];

        return Inertia::render('Users', $data);
    }   

    // public function edit(Request $request)
    // {
    //     return Inertia::render('Users');
    // }

    public function change(Request $request, $id) : RedirectResponse
    {
        // Send requests from Users.vue - to change data.
        // dd($id);
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];

        $user-> name = $request->input('name');
        $user-> admin_level = $request->input('adminDataRequest');
        $user->save();
        
        return redirect()->route('users.showData', ['id' => $id]);
        // return Inertia::render('Users', $data);
    }

}
