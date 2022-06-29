<?php

namespace App\Http\Livewire\Student;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\subjectAtendacnes;
use App\Models\Generate;
use App\Models\Weekday;
use App\Models\Subject;
use App\Models\User;
use App\Models\Archive;
class StudentScheduleVIew extends Component
{  use WithPagination;
    protected $paginationTheme = 'bootstrap';
     public $timeRange,$semesterId,$startSchoolYearId, $generates,$semesters,$studentSubjects,$subjectName,$teachers;

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
        $this->teachers = User::all();
        $this->subjectName = Subject::all();
        $this->generates = Generate::where('startSchool',$this->dt)->where('semester', $this->semesters)->get();
         $this->studentSubjects = subjectAtendacnes::where('startSchool',$this->dt)->where('idNumber',auth()->user()->idNumber)->where('semester', $this->semesters)->get();
         $this->subjectCount = subjectAtendacnes::where('startSchool',$this->dt)->where('idNumber',auth()->user()->idNumber)->where('semester', $this->semesters)->count();
       
    }


    public function render()
    {
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
        
        return view('livewire.student.student-schedule-v-iew',[
            'timeRange' => $this->timeRange,
            'weekDays' => $this->weekDays,
        ]);
    }
}
