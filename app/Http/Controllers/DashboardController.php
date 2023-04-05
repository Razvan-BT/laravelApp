<?php

namespace App\Http\Controllers;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Links;
use App\Models\User; 

class DashboardController extends Controller
{
    public function showData() {
        
        $links = Links::all();
        $data = [
            'links_' => $links,
        ];

        return Inertia::render('Links', $data);
    }

    public function showDataAccounts() {
        $links = User::all();
        $data = [
            'users' => $links,
        ];

        return Inertia::render('Accounts', $data);
    }

    public function insertLinks() {
        return Inertia::render('Insert');
    }

    public function AddLink(Request $request) {

        $link = new Links;

        $link->link = $request->input('link');
        $link->admin = $request->input('adminDataRequest');
        $link->location = $request->input('location');
        $link->by = $request->input('by');
        $link->description = $request->input('description');
        $link->save();

        return redirect()->route('dashboard.insert');
    }

    public function DeleteLink(Request $request) {
        
        $link = Links::find($request->input('id'));
        $link->delete();

        return redirect()->route('dashboard.links');

    }
}
