<?php

namespace App\Http\Livewire\Faculty;
use App\Models\User;
use App\Models\subjectAtendacnes;
use App\Models\Faculty;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FacultyProfile extends Component
{
    public $listeners = ['requestsConfirmed' => 'makeRequesting'];
    public $state=[];
    public $unitId,$FacultyR;

    public $rSubject,$oSubject;
    public function mount()
    {
        $this->refreshUnit();
        $this->updateUnits();
    }

    public function updateUnits(){

        $validatedData = Validator::make($this->state, [
            'units' => 'required',

            ])->validate();
            User::where('idNumber',auth()->user()->idNumber)->update($validatedData);
            Faculty::where('idNumber',auth()->user()->idNumber)->update($validatedData);
            $this->dispatchBrowserEvent('hide-form', ['message'=> 'successfully Update your Units!']);
            $this->refreshUnit();
    }

    public function refreshUnit()
    {

            $this->unitId = auth()->user()->units;

    }
    public function dataRequesting()
    {

        $this->dispatchBrowserEvent('Request-confirmation',['message'=>'Are You Sure You Want To Be A Scheduler?']);

    }
    public function makeRequesting()
    {


        $this->Faculty = User::where('idNumber',auth()->user()->idNumber)->get();
        foreach($this->Faculty as $resetzero)
        {
            $this->ids = $resetzero['id'];
            $FacultyR = User::find($this->ids);
            $FacultyR->status = 'requesting';
            $FacultyR->update();
        }
        $this->dispatchBrowserEvent('request-done',['message'=>'successfully sent a request']);
    }
    public function render()
    {
        $handleSubjects = Faculty::where('idnumber',auth()->user()->idNumber)->get();
        foreach($handleSubjects as $handleSubject)
        {
            $this->rSubject = $handleSubject['regular'];
            $this->oSubject = $handleSubject['overload'];
        }
        if($this->rSubject != ''){
            $tUnits =  ($this->rSubject +  $this->oSubject)/3;
        }else{
            $tUnits = 0;
        }
        $handledStudent = subjectAtendacnes::count();

        return view('livewire.faculty.faculty-profile',[
           'handleSubjects' =>  $tUnits,
           'handledStudent' => $handledStudent,
         ]);
    }
}
