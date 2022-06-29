<?php

namespace App\Http\Livewire\Admin\ScheduleView;

use App\Models\Archive;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Programs;
use App\Models\Generate;
use App\Models\weekday;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ListCourseSchedules extends Component
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
        public $courses,$years,$sections,$semesters,$generates,$timeRange;
        public $courseId,$yearId,$sectionId,$semesterId,$startSchoolYearId,$searchId,$weekDays,$generateId;


    //-------end variable--------//


//---------Start Update show modal---------//
    //---------Start Update show modal---------//
    public function searchId()
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
        $this->teachers = User::all();
        $this->dt = Carbon::now()->isoFormat('YYYY');

            $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
            $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
            if ($checkSemester != 0 && $checkSemester2 != 0) {
                $this->semesters = '1st';
            } elseif ($checkSemester2 != 0) {
                $this->semesters = '2nd';
            } else {
                $this->semesters = '1st';
            }

    $this->generates = Generate::where('course',$this->courseId)->where('year',$this->yearId)->where('section',$this->sectionId)->where('startSchool',$this->dt)->where('semester', $this->semesters)->get();

    }

    public function mount(){
        $this->dt = Carbon::now()->isoFormat('YYYY');
            $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
            $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
            if ($checkSemester != 0 && $checkSemester2 != 0) {
                $this->semesters = '1st';
            } elseif ($checkSemester2 != 0) {
                $this->semesters = '2nd';
            } else {
                $this->semesters = '1st';
            }

        $this->courses = Programs::where('role','active')->get();

        $this->getyears();
        $this->getSections();


    }
    public function updatedcourseId(){
        $this->getyears();
    }
    public function updatedYearId()
    {
         $this->getSections();
    }

    public function getYears()
    {
         if($this->courseId != ''){
        $this->years = Generate::where('course',$this->courseId)->get();
        }else{
             $this->years=[];
        }
    }
    public function getSections()
    {
        if($this->yearId != ''){
        $this->sections = Generate::where('course',$this->courseId)->where('year',$this->yearId)->get();
        }
         else{
             $this->sections=[];


        }
    }

    public function render()
    {


        return view('livewire.admin.schedule-view.list-course-schedules');
    }
}
