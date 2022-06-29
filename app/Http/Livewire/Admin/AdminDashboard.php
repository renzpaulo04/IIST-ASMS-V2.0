<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Generate;
use App\Models\Faculty;
use App\Models\Room;
class AdminDashboard extends Component
{
    public function render()
    {
        $roomActive = Room::where('available','ACTIVE')->count();
        $roomInactive = Room::where('available','INACTIVE')->count();
        $facultyActive = Faculty::where('activation','ACTIVE')->count();
        $facultyInactive = Faculty::where('activation','INACTIVE')->count();
        $createdTimeschedule = Generate::count();
        return view('livewire.admin.admin-dashboard',[
            'createdTimeschedule' => $createdTimeschedule,
            'facultyInactive' => $facultyInactive,
            'facultyActive' => $facultyActive,
            'roomActive' =>  $roomActive,
            'roomInactive' =>  $roomInactive,
        ]);
    }
}
