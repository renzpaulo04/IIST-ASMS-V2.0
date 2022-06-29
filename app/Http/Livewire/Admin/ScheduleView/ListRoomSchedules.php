<?php

namespace App\Http\Livewire\Admin\ScheduleView;

use App\Models\Archive;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Generate;
use App\Models\Faculty;
use App\Models\Room;
use App\Models\Weekday;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
class ListRoomSchedules extends Component
{

        //-------start variable------//
        use WithPagination;
        protected $listeners = ['deleteConfirmed' => 'deleteFacultyRows'];
        protected $paginationTheme = 'bootstrap';
        public $activation =null;
        public $state = [];
        public $room;
        public $showEditFacultyModal = false;
        public $deleteSelectedRows = null;
        public $selectedRows =[];
        public $selectedPageRows = false;
        public $search;
        public $timeRange,$semesterId,$startSchoolYearId,$showUnits, $generates,$semester;


    //-------end variable--------//


//---------Start Update show modal---------//
    //---------Start Update show modal---------//
    public function view(Room $room)
    {
        $this->showViewFacultyModal = true;
        $this->room=$room;
        $this->roomName = $room->toArray();

       $this->validatedData = Validator::make($this->roomName, [
            'room' => 'required|unique:rooms,room,'.$this->room->id,
            ])->validate();
            $this->dispatchBrowserEvent('showform');
        $time = Carbon::parse('07:30');
        $this->timeRange=[];

        do
        {
            array_push($this->timeRange,[

                'start' => $time->format("H:i"),
                ini_set('memory_limit', '-1'),
                'end' => $time->addMinutes(30)->format("H:i")
            ]);
        } while ($time->format("H:i") !== '19:30');
        $this->teachers = User::all();
        $this->showUnits = Room::where('room', $this->validatedData['room'])->get();
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
        $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
        if($checkSemester != 0 && $checkSemester2 != 0 )
        {
                $this->semesterId = '1st';
        }
        elseif($checkSemester2 != 0 ){
            $this->semesterId = '2nd';

        }else{
            $this->semesterId = '1st';

        }
        $this->generates = Generate::where('room', $this->validatedData['room'])->where('semester',$this->semesterId)->where('startSchool',$this->dt)->get();
     $this->dispatchBrowserEvent('showform');

    }
    public function mount(){
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
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
        $this->getGenerates();

    }

    public function updatedSemesterId()
{
   $this->getGenerates();

}
public function getGenerates()
{
    if($this->semesterId != ''){
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {
            $this->semesterId = '1st';
    }
    elseif($checkSemester2 != 0 ){
        $this->semesterId = '2nd';

    }else{
        $this->semesterId = '1st';

    }
        $this->generates = Generate::where('room', $this->validatedData['room'])->where('semester',$this->semesterId)->where('startSchool',$this->dt)->get();
    }
    else{
        $this->generates=[];
    }


}


    public function render()
    {
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $timeRange =$this->timeRange;
        $weekDays = Weekday::WEEK_DAYS;
        $rooms = Room::where('available','Active')->get();
        return view('livewire.admin.schedule-view.list-room-schedules',[
            'rooms' => $rooms,
            'weekDays' => $weekDays,
            'timeRange' => $timeRange,
            'dt' => $this->dt,



    ]);
    }
}
