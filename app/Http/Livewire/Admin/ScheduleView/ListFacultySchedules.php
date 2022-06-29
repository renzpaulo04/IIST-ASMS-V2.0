<?php

namespace App\Http\Livewire\Admin\ScheduleView;

use App\Models\Archive;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Generate;
use App\Models\Faculty;
use App\Models\Weekday;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

class ListFacultySchedules extends Component
{
    //-------start variable------//
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteFacultyRows'];
    protected $paginationTheme = 'bootstrap';
    public $activation = null;
    public $state = [];
    public $faculty;
    public $showEditFacultyModal = false;
    public $deleteSelectedRows = null;
    public $selectedRows = [];
    public $selectedPageRows = false;
    public $search, $dt;
    public $timeRange, $semesterId, $startSchoolYearId, $showUnits, $generates, $semester;


    //-------end variable--------//


    //---------Start Update show modal---------//
    //---------Start Update show modal---------//
    public function view(Faculty $faculty)
    {
        $this->showViewFacultyModal = true;
        $this->faculty = $faculty;
        $this->teacherName = $faculty->toArray();

        $this->validatedData = Validator::make($this->teacherName, [
            'idNumber' => 'required|unique:facultys,idNumber,' . $this->faculty->id,
            'firstName' => 'required',
            'lastName' => 'required',
            'units' => 'required',
        ])->validate();
        $this->dispatchBrowserEvent('showform');

        $this->teacher =  $this->validatedData;
        $time = Carbon::parse('07:30');
        $this->timeRange = [];

        do {
            array_push($this->timeRange, [

                'start' => $time->format("H:i"),
                ini_set('memory_limit', '-1'),
                'end' => $time->addMinutes(30)->format("H:i")
            ]);
        } while ($time->format("H:i") !== '19:30');
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
        $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
        if ($checkSemester != 0 && $checkSemester2 != 0) {
            $this->semesterId = '1st';
        } elseif ($checkSemester2 != 0) {
            $this->semesterId = '2nd';
        } else {
            $this->semesterId = '1st';
        }
        $this->showUnits = Faculty::where('idNumber', $this->validatedData['idNumber'])->get();
        $this->generates = Generate::where('teacher', $this->validatedData['idNumber'])->where('semester', $this->semesterId)->where('startSchool', $this->dt)->get();
        $this->dispatchBrowserEvent('showform');
    }

    public function render()
    {
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
        $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
        if ($checkSemester != 0 && $checkSemester2 != 0) {
            $this->semesters = '1st';
        } elseif ($checkSemester2 != 0) {
            $this->semesters = '2nd';
        } else {
            $this->semesters = '1st';
        }
        $dt = $this->dt;
        $timeRange = $this->timeRange;
        $weekDays = Weekday::WEEK_DAYS;
        $facultys = Faculty::where('activation', 'ACTIVE')->get();
        $facultyCount = Faculty::where('activation', 'ACTIVE')->count();
        return view('livewire.admin.schedule-view.list-faculty-schedules', [
            'facultys' => $facultys,
            'weekDays' => $weekDays,
            'timeRange' => $timeRange,
            'facultyCount' => $facultyCount,
            'dt' =>  $dt,




        ]);
    }
}
