<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.admin", $data);
    }

    public function teacher()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.teacher", $data);
    }
    
    public function librarian()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view("dashboard.librarian", $data);
    }
}

