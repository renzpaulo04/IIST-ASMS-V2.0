<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\subjectAtendacnes;
class StudentDashboard extends Component
{
    public function render()
    {
        $handledSubject = subjectAtendacnes::where('idNumber',auth()->user()->idNumber)->count();
        return view('livewire.student.student-dashboard',[
            'handledSubject' =>  $handledSubject, 
        ]);
    }
}
