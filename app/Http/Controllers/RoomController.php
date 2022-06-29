<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomListed;

class RoomController extends Controller
{
    public function index(){
        return view('admin/schedule/room');
    }

}
