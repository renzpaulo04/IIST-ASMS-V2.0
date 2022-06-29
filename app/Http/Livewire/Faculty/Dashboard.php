<?php

namespace App\Http\Livewire\Faculty;

use Livewire\Component;
use App\Models\User;
use App\Models\Faculty;
use App\Models\subjectAtendacnes;
use Illuminate\Support\Facades\Validator;

class Dashboard extends Component
{
    protected $listeners = ['requestsConfirmed' => 'updateRequest'];
    public $tUnits,$oSubject,$rSubject;


    public function render()
    {
        $handleSubjects = Faculty::where('idnumber',auth()->user()->idNumber)->get();
        foreach($handleSubjects as $handleSubject)
        {
            $this->rSubject = $handleSubject['regular'];
            $this->oSubject = $handleSubject['overload'];
        }


        $this->tUnits =  ($this->rSubject + $this->oSubject)/3;

        $handledStudent = subjectAtendacnes::count();

        return view('livewire.faculty.dashboard',[
            'handleSubjects' =>  $this->tUnits,
            'handledStudent' => $handledStudent,
         ]);
    }
}
