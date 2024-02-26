<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pages.profile');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try{



           User::where('id','=',Auth::id())->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone'=>$request->input('phone'),
                'shop_name' => $request->input('shop_name'),
                'shop_address' => $request->input('shop_address'),

            ]);

           return redirect()->route('profile.index')->with('success','student updated successfully');


        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changePassword(Request $request)
    {

        try{


            $user = User::find(Auth::id());

            if(Hash::check($request->input('password'),$user->password)){

                $user->password = Hash::make($request->input('newpassword'));
                $user->save();

                return redirect()->route('profile.index')->with('success','Password changed successfully');

            }else{
                return redirect()->route('profile.index')->with('error','Old password does not match');
            }

    }
        catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}

