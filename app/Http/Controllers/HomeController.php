<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function contactForm()
    {
        return view('contact.form');
    }
}