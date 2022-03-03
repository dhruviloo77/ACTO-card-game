<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request) {

        $user = new UserController;

        
        return view('index');
    }

    public function cards() {
        $cards = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        return $cards;
    }
    
}
