<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Countries;

class ProfileController extends Controller
{
    public function edit(REQUEST $request){

        $user = Auth::user();
        $countries=Countries::getNames();
        $locales = Languages::getNames();

        return view('dashboard.profile.edit',compact('user','countries','locales'));

    }

    public function update(REQUEST $request){

        $request->validate([
            'first_name' =>['string','required','max:255'],
            'last_name' =>['string','required','max:255'],
            'birthday' =>['date','nullable','before:today'],
            'gender' =>['in:male,female'],
            'country' =>['required','size:2' ,'string'],
        ]);

        $user = $request->user();

        $user->profile->fill($request->all())->save();

        return redirect()->route('dashboard.profile.edit')
        ->with('success', 'Profile has been updated');


    }
}
