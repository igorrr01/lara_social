<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
  public function __construct()
  {
/*    //its just a dummy data object.
    $user = User::all();

    // Sharing is caring
    View::share('user', $user);

    view()->share('data', [1, 2, 3]);*/


  }
}