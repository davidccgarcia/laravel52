<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Experience;
use App\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::first();

        return view('users.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            // 'technology.*' => 'required|between: 2,10', 
            'experience.*.technology' => 'between: 2,10', 
            'experience.*.years'      => 'required_with:experience.*.technology|integer'
            // 'years.*'      => 'required|integer', 
            // 'years.*'      => 'required_with:technology.*|integer'
        ]);
        
        $user = User::first();
        $user->experiences()->delete();
        $experiences = [];

        foreach($request->get('experience') as $item) {
            if (! $item['technology']) {
                continue;
            }

            $experiences[] = new Experience([
                'name'  => $item['technology'], 
                'years' => $item['years']
            ]);
        }

        $user->experiences()->saveMany($experiences);

        return back();

    }
}
