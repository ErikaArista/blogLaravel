<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;
use App\Models\Article;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $articles = Article::where([
            ['user_id', $profile->user_id], 
            ['status', '1']])
            ->simplePaginate(8);
        
        return view('subscriber.profiles.show', compact('profile','articles'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('subscribe.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $user = Auth::user();

        if($request->hasFile('photo'))
        {
            File::delete(public_path('storage/' . $profile ->photo));
            $photo  = $request['photo']->store('profiles');

        }else{
            $photo = $user->profile->photo;
        }

        //asignar nombre y correo
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        //Asignar campos adicionales 
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        $user->profile->photo = $photo;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook; 
        //asignar foto
        $user->profile->photo = $photo;
        //Guardar campos de perfil 
        $user->profile->save();
        return redirect()->route('profiles.edit', $user->profile->id);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
