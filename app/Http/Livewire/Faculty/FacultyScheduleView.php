<?php

namespace App\Http\Livewire\Faculty;

use App\Models\Archive;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Faculty;
use App\Models\Generate;
use App\Models\Weekday;
use App\Models\Subject;


class FacultyScheduleView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
     public $timeRange,$semesterId,$startSchoolYearId,$showUnits, $generates,$semester,$subjectName,$dt;


     public function mount(){
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

    }



    public function render()
    {
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $this->subjectName = Subject::all();
        $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
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
         $this->generates = Generate::where('startSchool', $this->dt)->where('teacher',auth()->user()->idNumber)->where('semester',$this->semesterId)->get();
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

        $this->weekDays = Weekday::WEEK_DAYS;
        return view('livewire.faculty.faculty-schedule-view',[
            'timeRange' => $this->timeRange,
            'weekDays' => $this->weekDays,
        ]);
    }
}
