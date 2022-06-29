<?php

namespace App\Http\Livewire\Guest;

use App\Models\Archive;
use App\Models\Faculty;
use App\Models\Generate;
use App\Models\guestForm;
use App\Models\Room;
use App\Models\Weekday;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class GuestDashboard extends Component
{
    public $dayId,$roomId,$teacherId,$state;

    public function createForm()
    {

        $validatedData = Validator::make($this->state, [
            'day' => 'required',
            'room' => 'required',
            'teacher' =>'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'noStudent' => 'required',

        ])->validate();


        guestForm::create([
            'day' => $validatedData['day'],
            'room' => $validatedData['room'],
            'teacher' => $validatedData['teacher'],
            'startTime' => $validatedData['startTime'],
            'endTime'  => $validatedData['endTime'],
            'noStudent'  => $validatedData['noStudent'],

        ]);
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Borrowing CLass Room has been save!']);

        return redirect()->back();


    }
    public function mount()
    {
        $this->facultys = Faculty::where('activation','ACTIVE')->get();
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
        $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
        if($checkSemester != 0 && $checkSemester2 != 0 )
        {
                $this->semesters = '1st';
        }
        elseif($checkSemester2 != 0 ){
            $this->semesters = '2nd';
        }else{
            $this->semesters = '1st';
        }
        $this->getTeachers();
        $this->getRooms();
        $this->getWeekdays();



    }

    public function updatedDayId(){
        $this->getRooms();
        $this->getTeachers();

    }
    public function updatedRoomId(){
        $this->getTeachers();
    }
    public function getWeekdays()
    {
        $this->weekdays = Weekday::WEEK_DAYS;
    }


    public function getRooms()
    {

        if ($this->dayId != ''){
            $activate = 'ACTIVE';
            $this->rooms = Room::where('available', $activate)->get();
        }
        else{
            $this->rooms = [];
            $this->Fteachers = [];
        }
    }
    public function getTeachers(){
        if ($this->roomId != '')
        {
            $this->teachers = Generate::where('weekday',$this->dayId)->where('room',$this->roomId)->get();
            $this->Fteachers = Faculty::where('activation', 'ACTIVE')->get();
        }
        else{
            $this->Fteachers = [];

        }
    }

    public function render()
    {


        return view('livewire.guest.guest-dashboard');
    }
}
