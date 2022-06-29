<?php

namespace App\Http\Livewire\Faculty;

use App\Models\Archive;
use Livewire\Component;
use App\Models\Faculty;
use App\Models\Generate;
use App\Models\User;
use App\Models\subjectAtendacnes;
use App\Models\stockAttendance;
use Carbon\carbon;
use App\Models\studentAttendance;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class FacultyAttendance extends Component
{
    public $semesters,$sections,$subjects,$semesterstimes,$sectionstimes,$subjectstimes,$students,$studentNames,$student;
    public $semesterId,$sectionId,$startSchoolYearId,$subjectId,$IdNumberId,$lastNameId,$firstNameId;
    public $semesterIds,$sectionIds,$startSchoolYearIds,$subjectIds,$idNumberId,$startTimeId,$endTimeId,$roomId,$tablePages;    
    public $selectedRows =[];
    public $selectedPageRows = false;
    public $inputs = [];
    public $i = 1;
    public $activeC,$activeS,$dt,$activeM;
    public $attendance =null;

    public function add($i)
{
    $i = $i + 1;
    $this->i = $i;
    array_push($this->inputs,$i);
}
public function remove($i)
{
    unset($this->inputs[$i]);
}
public function c_attendance(){
    $this->activeC ='active';
    $this->activeS ='hide';
    $this->activeM ='hide';
}
public function s_attendance(){
    $this->activeC = 'hide';
    $this->activeS ='active';
    $this->activeM ='hide';
}
public function m_attendance(){
    $this->activeC = 'hide';
    $this->activeM ='active';
    $this->activeS ='hide';
    

}

private function resetInputsFields(){
    $this->startSchoolYearId = '';
    $this->semesterId = '';
    $this->sectionId = '';
    $this->IdNumberId = '';
    $this->lastnameId = '';
    $this->firstnameId = '';
    $this->subjectId = '';

}
public function createStudent()
{
    $validatedDate = $this->validate([
        'sectionId' => 'required',
        'subjectId' => 'required',
        'IdNumberId.0' => 'required',
        'lastNameId.0' => 'required',
        'firstNameId.0' => 'required',
        'IdNumberId.*' => 'required',
        'lastNameId.*' => 'required',
        'firstNameId.*' => 'required',
    ]);
    foreach ($this->IdNumberId as $key => $value){
        $this->dt = Carbon::now()->isoFormat('YYYY');
        $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
        $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
        if($checkSemester != 0 && $checkSemester2 != 0 )
        {
                $this->SCY =  $this->dt ;
                $this->semesters = '1st';
        }
        elseif($checkSemester2 != 0 ){
            $this->SCY =  $this->dt - 1;
            $this->semesters = '2nd';

        }else{
            $this->SCY =  $this->dt ;
            $this->semesters = '1st';

        }
        subjectAtendacnes::create([
            'startSchool' => $this->SCY,
            'semester' => $this->semesters,
            'section' => $this->sectionId,
            'subject' => $this->subjectId,
            'idNumber' => $this->IdNumberId[$key],
            'lastName' => $this->lastNameId[$key],
            'firstName' => $this->firstNameId[$key],
            'teacher' => auth()->user()->idNumber,
        ]);
    stockAttendance::create([
            'startSchool' => $this->SCY,
            'semester' => $this->semesters,
            'section' => $this->sectionId,
            'subject' => $this->subjectId,
            'idNumber' => $this->IdNumberId[$key],
            'lastName' => $this->lastNameId[$key],
            'firstName' => $this->firstNameId[$key],
            'teacher' => auth()->user()->idNumber,
        ]);
    }
    $this->inputs=[];
    $this->resetInputsFields();
    $this->dispatchBrowserEvent('hide-form', ['message'=> 'students added successfully!']);

    return redirect()->back();

}

    public function mount(){
       
        $this->dt = Carbon::now()->isoFormat('YYYY');
      $this->sections = Generate::where('teacher',auth()->user()->idNumber)->get();
      $this->subjects = Generate::where('teacher',auth()->user()->idNumber)
      ->where('section',$this->sectionId)
      ->get();
        $this->getSection();
       $this->getSubjects();
       $this->getSectionstimes();
      $this->getSubjectstimes();
        $this->getStudents();
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
        $this->markAsPresent();
        $this->markAsLate();
    }
   
    public function  updatedSection(){
        $this->getSubjects();
    }

    public function getsection()
    {
        if($this->sectionId != '')
        {
            $this->subjects = Generate::where('teacher',auth()->user()->idNumber)
            ->where('section',$this->sectionId)
            ->get();
        }else{
            $this->subjects=[];
        }
    }




// create attendance student//
    public function updatedSectionId()
    {
        $this->getSubjects();
    }

    public function getSubjects()
    {
        if($this->sectionId != '')
        {
            $this->subjects = Generate::where('teacher',auth()->user()->idNumber)->where('section',$this->sectionId)->get();
        
        }else{
            $this->subjects=[];
     
        }
    }

// start attendance student//

public function updatedSectionIds()
{
    $this->getSubjectstimes();
    $this->getStudents();
}
public function updatedSubjectIds()
{
    $this->getStudents();
}

public function getSectionstimes()
{
    $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {
            $this->semesters = '1st';
            $this->SCY =  $this->dt ;
    }
    elseif($checkSemester2 != 0 ){
        $this->semesters = '2nd';
        $this->SCY =  $this->dt - 1;
    }else{
        $this->semesters = '1st';
        $this->SCY =  $this->dt ;
    }

        $this->sectionstimes =subjectAtendacnes::where('teacher',auth()->user()->idNumber)->where('startSchool',$this->SCY)->where('semester',$this->semesters)->get();

}
public function getSubjectstimes()
{
    $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {
            $this->semesters = '1st';
            $this->SCY =  $this->dt ;
    }
    elseif($checkSemester2 != 0 ){
        $this->semesters = '2nd';
        $this->SCY =  $this->dt;

    }else{
        $this->semesters = '1st';
        $this->SCY =  $this->dt ;

    }
    if($this->sectionIds != '')
    {

        $this->subjectstimes =subjectAtendacnes::where('teacher',auth()->user()->idNumber)
        ->where('startSchool',$this->SCY)
        ->where('semester',$this->semesters)
        ->where('section',$this->sectionIds)
        ->get();
    }else{
        $this->subjectstimes=[];
    }
}

public function getStudents()
{
    $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {
            $this->semesters = '1st';
            $this->SCY =  $this->dt ;
    }
    elseif($checkSemester2 != 0 ){
        $this->semesters = '2nd';
        $this->SCY =  $this->dt - 1;

    }else{
        $this->semesters = '1st';
        $this->SCY =  $this->dt ;

    }
    if($this->subjectIds != '')
    {
        $this->students =stockAttendance::where('teacher',auth()->user()->idNumber)
        ->where('startSchool',$this->SCY)
        ->where('semester',$this->semesters)
        ->where('section',$this->sectionIds)
        ->where('subject',$this->subjectIds)
        ->get();
    
   
    }else{
        $this->students=[];

    }
}
public function filterStockAttendanceByAttendance($attendance =null){
    $this->attendance = $attendance;
}

//------------Update Selected Page Rows-----------//
public function updatedSelectedPageRows($value)
{
    if ($value){
        $this->selectedRows = $this->student->pluck('id')->map(function($id){
            return (string) $id;
        
        });
       
    } else{
        $this->reset(['selectedRows','selectedPageRows','tablePages','student']);
    }
}
//------------Mark As Activated-----------//
public function markAsPresent()
{   
    stockAttendance::whereIn('id', $this->selectedRows)->update(['attendance'=>'PRESENT']);
    $this->reset(['selectedPageRows','selectedRows','student']);
    $this->dispatchBrowserEvent('updated-active', ['message'=> 'Successfully Changed!']);
    
    


}
public function markAsLate()
{   
    stockAttendance::whereIn('id', $this->selectedRows)->update(['attendance'=>'LATE']);
    $this->reset(['selectedPageRows','selectedRows','tablePages','student']);
    $this->dispatchBrowserEvent('updated-active', ['message'=> 'Successfully Changed!']);
    
}
public function markAsAbsent()
{   
    stockAttendance::whereIn('id', $this->selectedRows)->update(['attendance'=>'ABSENT']);
    $this->dispatchBrowserEvent('updated-active', ['message'=> 'Successfully Changed!']);
    $this->reset(['selectedPageRows','selectedRows','tablePages','student']);
}

public function saveAttendance(){
    
}
    public function render()
    {
       $students =  $this->students;
        return view('livewire.faculty.faculty-attendance',[
            'students' =>  $students,
        ]);
    }
}
