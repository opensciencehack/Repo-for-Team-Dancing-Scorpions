<?php
/**
 * Created by PhpStorm.
 * User: Osama
 * Date: 12/2/2016
 * Time: 10:18 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function Welcome(Request $request){




        return response()
            ->view('home')
            ;


    }
}