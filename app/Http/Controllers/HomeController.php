<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $members = Member::all();
        $siteContent = SiteContent::all();

        return view('home', [
            'members' => $members,
            'siteContent' => $siteContent
        ]);
    }
}

