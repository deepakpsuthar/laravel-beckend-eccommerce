<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

   public function index(){
        $totalClients =User::role('client')->count();
        $totalProducts = Product::count();

        return view('admin.dashboard',compact('totalClients','totalProducts'));
   }
}
