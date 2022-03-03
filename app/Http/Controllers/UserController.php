<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'inputName' => 'required',
            'inputCard' => ['required', 'regex:/[2-9]|[10]|[A|K|J|Q]/']
        ]);

        $data = [];
        $card = new CardController;
        $cards = $card->cards();
        $number_of_hands = strlen(str_replace(" ", "", $request->inputCard));
        $user_hand = explode(" ", $request->inputCard);
        //  dd($number_of_hands);
        $random_key = array_rand($cards, $number_of_hands);

        $user_name = $request->inputName;
        $user_score = 0;
        $opponent_score = 0;

        foreach ($random_key as $r) {
            $opponent_hand[] = $cards[$r];
        }

        for ($i = 0; $i < count($user_hand); $i++) {

            if (is_numeric($user_hand[$i]) && is_numeric($opponent_hand[$i])) {
                if ($user_hand[$i] >= $opponent_hand[$i]) {
                    $user_score = $user_score + 1;
                } else {
                    $opponent_score = $opponent_score + 1;
                }
            } elseif (ctype_alpha($user_hand[$i]) && is_numeric($opponent_hand[$i])) {
                $user_score = $user_score + 1;
            } elseif (ctype_alpha($opponent_hand[$i]) && is_numeric($user_hand[$i])) {
                $opponent_score = $opponent_score + 1;
            } elseif (ctype_alpha($opponent_hand[$i]) && ctype_alpha($user_hand[$i])) {
                if ($user_hand[$i] == 'A') {
                    $user_score = $user_score + 1;
                } elseif ($user_hand[$i] == 'K' && $opponent_hand[$i] == 'Q' || $opponent_hand[$i] == 'J') {
                    $user_score = $user_score + 1;
                } elseif ($user_hand[$i] == 'Q' && $opponent_hand[$i] == 'J') {
                    $user_score = $user_score + 1;
                } elseif ($user_hand[$i] == 'J' && $opponent_hand[$i] == 'J') {
                    $user_score = $user_score + 1;
                } else {
                    $opponent_score = $opponent_score + 1;
                }
            } else {
                $opponent_score = $opponent_score + 1;
            }
        }

        $user = new User();

        $user->name = $user_name;
        $user->score = $user_score;
        $user->opponent_score = $opponent_score;
        $user->won = $user_score > $opponent_score ? 1 : 0;
        $user->games_won = DB::table('users')->where('won', '=', 1)->sum('won');

        $user->save();

        $user_names = DB::table('users')->select('name')->groupBy('name')->get();
        //dd($user_names);
        $users = User::all();

        return view('index', compact('user_name', 'user_hand', 'opponent_hand', 'user_score', 'opponent_score', 'users','user_names'));
    }
}
