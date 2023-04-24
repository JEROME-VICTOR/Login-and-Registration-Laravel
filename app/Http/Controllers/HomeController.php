<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
use Input;
use Session;
use App\Models\User;
use ReflectionClass;

/**
 * Handle response after user authenticated
 *
 * @param Request $request
 * @param Auth $user
 *
 * @return \Illuminate\Http\Response
 */

class HomeController extends Controller
{
    public function index($id=null)
    {
        $userprofile = User::find($id);
        $user_data = $this->accessProtected($userprofile, 'attributes');
        return view('home.index', compact('user_data'));
    }

    public function edit($id)
    {
        $userprofile = User::whereid($id)->firstOrFail();
        $userprofile->wallet_balance = $userprofile->wallet_balance + Input::get('deposit_amount');
        $userprofile->save();
        $user_data = $this->accessProtected($userprofile, 'attributes');
        return redirect()->route('home.index', $id);
        #return view('home.index', compact('user_data'));
    }

     function accessProtected($obj, $prop) {
        try{
            $reflection = new ReflectionClass($obj);
            $property = $reflection->getProperty($prop);
            $property->setAccessible(true);
            return $property->getValue($obj);
        } catch (\ReflectionException $e) {
            return "Error";
        }
     }
}
