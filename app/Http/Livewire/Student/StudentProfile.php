<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\subjectAtendacnes;

class StudentProfile extends Component
{
    public function render()
    {
        $handledSubject = subjectAtendacnes::where('idNumber',auth()->user()->idNumber)->count();
        return view('livewire.student.student-profile',[
            'handledSubject' =>  $handledSubject, 
        ]);
    }
}
