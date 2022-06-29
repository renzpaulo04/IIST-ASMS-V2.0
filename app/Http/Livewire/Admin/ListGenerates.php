<?php

namespace App\Http\Livewire\Admin;

use App\Models\Archive;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Subject;
use App\Models\Programs;
use App\Models\Faculty;
use App\Models\Room;
use App\Models\Weekday;
use App\Models\Generate;
use Carbon\carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Echo_;
use App\Models\User;
use App\Models\subjectAtendacnes;
use App\Models\Unit;

class ListGenerates extends Component
{
           //-------start variable------//
            use WithPagination;
            protected $listeners = ['overrideConfirmed' => 'overrideSave','overloadsConfirmed' => 'overloadSave','resetsConfirmed' => 'resetActivites','timesConfirmed' =>'notAvailableTime','timesFConfirmed'=> 'notAvailableTimeF','timesSConfirmed'=> 'notAvailableTimeS' ];
            protected $paginationTheme = 'bootstrap';
            public $showEditGenerateModal = false;
            public $courses,$weekdays,$semesters,$subjects,$sections,$teachers,$rooms,$generates;
            public $courseId,$semesterId,$yearId,$subjectId,$sectionId,$teacherId,$roomId,$weekdayId,$startTimeId,$endTimeId,$startSchoolYearId;
            public $state= [];
            public $i = 1;
            public $b;
            public $timeRange;
            public $courseview = null;
            public $inputs = [];
            public $search;
            public $dayGet,$generatesgets,$timeStartGet,$timeRanges,$regularClass,$specialClass,$regularId,$specialId,$ActiveR,$ActiveS,$ActiveSp,$filterRoomsByAvailable;
            public $dates = ['startTime','endTime'];







       //-------end variable--------//,$tota
       //---------start Add New Schedule showing modal--------//
           public function addNew()
           {
               $this->showEditGenerateModal = false;
               $this->dispatchBrowserEvent('show-form');

           }
       //---Create schedule---//
           public function createGenerate()
           {

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
        $this->getCourses();
        $this->getYears();
        $this->getSubjects();
        $this->getSections();
        $this->getRooms();
        $this->getWeekdays();



    }
    public function updatedTeacherId(){
        $this->getTeachers();
        $this->getCourses();
        $this->getYears();
        $this->getSections();
        $this->getSubjects();
        $this->getRooms();
    }

    public function updatedCourseId()
    {
        $this->getYears();
        $this->getSections();
        $this->getSubjects();
        $this->getRooms();
    }
    public function updatedYearId(){
        $this->getSections();
        $this->getSubjects();
        $this->getRooms();

    }
    public function updatedSectionId()
    {

        $this->getSubjects();
        $this->getRooms();

    }
    public function updatedSubjectId(){
        $this->getRooms();
        $this->getWeekdays();
    }
    public function updatedRoomId(){
        $this->getWeekdays();
    }

public function getTeachers(){
        if ($this->teacherId != '')
        {
            $this->teachers = User::where('idNumber',$this->teacherId)->get();


        }
        else{
            $this->teachers = [];
            $this->courses = [];
            $this->years = [];
            $this->sections= [];
            $this->subjects = [];

        }
    }

public function getCourses(){
    if ($this->teacherId != '')
    {
        $this->courses = Programs::where('role','ACTIVE')->get();
    }
    else{
        $this->courses = [];
        $this->years = [];
        $this->sections= [];
        $this->subjects = [];
        $this->rooms = [];
        $this->weekdays = [];

    }
}

public function getYears()
    {
        if ($this->courseId != ''){
            $this->years =Subject::where('course_code', $this->courseId)->get();

        }

        else{
            $this->years = [];
            $this->sections= [];
            $this->subjects = [];
            $this->rooms = [];
            $this->weekdays = [];
        }
    }
    public function getSections(){
        if ($this->yearId != ''){
            $this->sections =['A','B','C','D','E','F','G','H'];

        }
        else{
            $this->sections= [];
            $this->subjects = [];
            $this->rooms = [];
            $this->weekdays = [];
        }
    }
    public function getSubjects()
    {
        if($this->ActiveR == null){

            if ($this->sectionId != '' && $this->ActiveR == null){
                $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
                $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
                if($checkSemester != 0 && $checkSemester2 != 0 )
                {
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }
                elseif($checkSemester2 != 0 ){
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }else{
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }

            } else{
                $this->subjects = [];
                $this->rooms = [];
                $this->weekdays = [];

            }
        }elseif($this->ActiveR == "hide"){

            if ($this->sectionId != '' && $this->ActiveR == "hide"){
                $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
                $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
                if($checkSemester != 0 && $checkSemester2 != 0 )
                {
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }
                elseif($checkSemester2 != 0 ){
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }else{
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }

            } else{
                $this->subjects = [];
                $this->rooms = [];
                $this->weekdays = [];
            }
        }

    }

    public function getRooms()
    {

        if ($this->subjectId != ''){
            $activate = 'ACTIVE';
            $this->rooms = Room::where('available', $activate)->get();
        }
        else{
            $this->rooms = [];
            $this->weekdays = [];
        }
    }
    public function getWeekdays()
    {
        if ($this->roomId != ''){
            $this->weekdays = Weekday::WEEK_DAYS;
        }
        else{
            $this->weekdays = [];
        }
    }

    public function regularClass($ActiveR = null)
    {
        $this->ActiveR = $ActiveR;
        if($this->ActiveR == null){
            $this->ActiveS = "active";
            $this->ActiveSp = "hide";

            if ($this->sectionId != '' && $this->ActiveR == null){
                $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
                $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
                if($checkSemester != 0 && $checkSemester2 != 0 )
                {
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }
                elseif($checkSemester2 != 0 ){
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }else{
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }

            } else{
                $this->subjects = [];

            }

        }elseif($this->ActiveR == "hide"){
            $this->ActiveS = "hide";
            $this->ActiveSp = "active";
            if ($this->sectionId != ''){
                $checkSemester = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','2nd')->count();
                $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
                if($checkSemester != 0 && $checkSemester2 != 0 )
                {
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }
                elseif($checkSemester2 != 0 ){
                    $this->subjects =Subject::where('semester', '1st')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }else{
                    $this->subjects =Subject::where('semester', '2nd')
                    ->where('course_code',$this->courseId)
                    ->where('year', $this->yearId)->get();
                }

            } else{
                $this->subjects = [];

            }

        }

    }

    public function add()
{
    $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {

            $dtoday = Carbon::now()->isoFormat('YYYY');
        $this->semesterId = '1st';
        $this->sCy = $dtoday;
        $this->sCe = $dtoday + 1;
    }
    elseif($checkSemester2 != 0 ){
        $dtoday = Carbon::now()->isoFormat('YYYY');
        $this->semesterId = '2nd';
        $this->sCy = $dtoday - 1;
        $this->sCe = $dtoday;
    }else{
        $dtoday = Carbon::now()->isoFormat('YYYY');
        $this->semesterId = '1st';
        $this->sCy = $dtoday;
        $this->sCe = $dtoday + 1;
    }


    $validatedDate = $this->validate([
        'teacherId' =>'required',
        'courseId' =>'required',
        'yearId' =>'required',
        'sectionId' =>'required',
        'subjectId' =>'required',
        'roomId' =>'required',
         'weekdayId' =>'required',
         'startTimeId' =>'required',
        'endTimeId' =>'required',

    ]);
     $startTime = Carbon::createFromTimeString($this->startTimeId);
     $endTime = Carbon::createFromTimeString($this->endTimeId);
     $endOfTime =Carbon::parse( $endTime);
     $startOfTime =Carbon::parse($startTime);

     //-----time check First-----//
     if($endOfTime->between('08:30:00','19:30:00') && $startOfTime->between('07:30:00','18:30:00')){
         if($startOfTime < $endOfTime){

        $dtoday = Carbon::now()->isoFormat('YYYY');
     $eTime =Carbon::parse($endTime)->subMinutes()->format('H:i');
     $sTime =Carbon::parse($startTime)->addMinutes()->format('H:i');
     $timeCheckCountStudent= Generate::where('course', $this->courseId)
     ->where('year', $this->yearId)
     ->where('section', $this->sectionId)
     ->where('weekday', $this->weekdayId)
     ->where('startSchool',$dtoday)
     ->where('semester', $this->semesterId)
     ->where('startTime', '<=', $eTime )
     ->where('endTime','>=', $sTime)->count();

        if($timeCheckCountStudent == 0){

            $timeCheckCount= Generate::where('room', $this->roomId)
            ->where('weekday', $this->weekdayId)
            ->where('startTime', '<=', $eTime )
            ->where('startSchool',  $dtoday)
            ->where('semester', $this->semesterId)
            ->where('endTime','>=', $sTime)->count();

                    if($timeCheckCount == 0){
                    $timeCheckCountFaculty= Generate::where('teacher', $this->teacherId)
                    ->where('weekday', $this->weekdayId)
                    ->where('startTime', '<=', $eTime )
                    ->where('startSchool',  $dtoday)
                    ->where('semester', $this->semesterId)
                    ->where('endTime','>=', $sTime)->count();
                                    if( $timeCheckCountFaculty == 0){
                                    $getUnitsFaculty = Faculty::where('idNumber',$this->teacherId)->get();
                                    foreach( $getUnitsFaculty as $Faculty)
                                    {
                                        $this->facultyRegular =  $Faculty['regular'];
                                        $facultyOverload =  $Faculty['overload'];
                                        $facultyUnits =  $Faculty['units'];
                                        $this->FfirstName =$Faculty['firstName'];
                                            $this->FlastName =$Faculty['lastName'];
                                            $this->Fid =$Faculty['id'];
                                                }
                                        $getUnitsSubject =Subject::where('course_code',$this->courseId)
                                        ->where('subject_Code',$this->subjectId)->get();
                                        foreach($getUnitsSubject as $unitSubject)
                                            {
                                                $this->subjectUnits =  $unitSubject['lecHours'];
                                                $subjectLabs =  $unitSubject['labHours'];

                                            }
                                            $subjectMultiple= Generate::where('course', $this->courseId)
                                            ->where('year', $this->yearId)
                                            ->where('section', $this->sectionId)
                                            ->where('subject', $this->subjectId)
                                            ->where('startSchool',$this->sCy)
                                            ->where('semester', $this->semesterId)
                                            ->where('teacher',$this->teacherId)->count();
                                            if($subjectMultiple != '0'){

                                                $this->dt = Carbon::now()->isoFormat('YYYY');
                                                $saveStartTime = Carbon::createFromTimeString($this->startTimeId)->format('H:i');
                                                $saveEndTime = Carbon::createFromTimeString($this->endTimeId)->format('H:i');
                                                $diff = Carbon::parse( $saveStartTime)->diffInMinutes( $saveEndTime );
                                                $Generate = new Generate;
                                                $Generate->course =$this->courseId;
                                                $Generate->year = $this->yearId;
                                                $Generate->section =$this->sectionId;
                                                $Generate->semester = $this->semesterId;
                                                $Generate->subject = $this->subjectId;
                                                $Generate->teacher =$this->teacherId;
                                                $Generate->room =$this->roomId;
                                                $Generate->weekday =$this->weekdayId;
                                                $Generate->startTime =$saveStartTime;
                                                $Generate->endTime =$saveEndTime;
                                                $Generate->startSchool =$this->sCy;
                                                $Generate->endSchool = $this->sCe;
                                                $Generate->difference =$diff;
                                                $Generate->created_by = auth()->user()->idNumber;
                                                $Generate->save();

                                                $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
                                                return redirect()->back();
                                            }else{

                                                    if($subjectLabs == 0 || $subjectLabs == '')
                                                    {
                                                        $this->labUnits = 0;
                                                    }else
                                                    {
                                                        $this->labUnits = $subjectLabs * 0.75;
                                                    }
                                                    $this->disignation = 21 - $facultyUnits;

                                                 $this->tolalUnits =  $this->subjectUnits + $this->facultyRegular + $this->labUnits;
                                                 $this->tolalUnitsO =  $this->subjectUnits + $facultyOverload + $this->labUnits;
                                                 $this->overloadView =  $this->facultyRegular + $facultyUnits + $this->tolalUnitsO;

                                                if($this->facultyRegular != $this->disignation)
                                                {


                                                        if($this->disignation <  $this->tolalUnits )
                                                        {
                                                            $this->dt = Carbon::now()->isoFormat('YYYY');
                                                            $this->totalCount =  $this->tolalUnits  - $this->disignation;
                                                            $saveStartTime = Carbon::createFromTimeString($this->startTimeId)->format('H:i');
                                                            $saveEndTime = Carbon::createFromTimeString($this->endTimeId)->format('H:i');
                                                            $diff = Carbon::parse( $saveStartTime)->diffInMinutes( $saveEndTime );
                                                            $Generate = new Generate;
                                                            $Generate->course =$this->courseId;
                                                            $Generate->year = $this->yearId;
                                                            $Generate->section =$this->sectionId;
                                                            $Generate->semester = $this->semesterId;
                                                            $Generate->subject = $this->subjectId;
                                                            $Generate->teacher =$this->teacherId;
                                                            $Generate->room =$this->roomId;
                                                            $Generate->weekday =$this->weekdayId;
                                                            $Generate->startTime =$saveStartTime;
                                                            $Generate->endTime =$saveEndTime;
                                                            $Generate->startSchool = $this->sCy;
                                                            $Generate->endSchool =  $this->sCe ;
                                                            $Generate->difference =$diff;
                                                            $Generate->created_by = auth()->user()->idNumber;
                                                            $Generate->save();
                                                            $Faculty = Faculty::find($this->Fid);
                                                            $Faculty->overload = $this->totalCount;
                                                            $Faculty->regular = $this->disignation;
                                                            $Faculty->update();
                                                            $this->inputs=[];
                                                            $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
                                                            return redirect()->back();
                                                        }else
                                                        {
                                                            $this->dt = Carbon::now()->isoFormat('YYYY');
                                                            $saveStartTime = Carbon::createFromTimeString($this->startTimeId)->format('H:i');
                                                            $saveEndTime = Carbon::createFromTimeString($this->endTimeId)->format('H:i');
                                                            $diff = Carbon::parse( $saveStartTime)->diffInMinutes( $saveEndTime );
                                                            $Generate = new Generate;
                                                            $Generate->course =$this->courseId;
                                                            $Generate->year = $this->yearId;
                                                            $Generate->section =$this->sectionId;
                                                            $Generate->semester = $this->semesterId;
                                                            $Generate->subject = $this->subjectId;
                                                            $Generate->teacher =$this->teacherId;
                                                            $Generate->room =$this->roomId;
                                                            $Generate->weekday =$this->weekdayId;
                                                            $Generate->startTime =$saveStartTime;
                                                            $Generate->endTime =$saveEndTime;
                                                            $Generate->startSchool =$this->sCy;
                                                            $Generate->endSchool = $this->sCe;
                                                            $Generate->difference =$diff;
                                                            $Generate->created_by = auth()->user()->idNumber;
                                                            $Generate->save();
                                                            $Faculty = Faculty::find($this->Fid);
                                                            $Faculty->regular =  $this->tolalUnits ;
                                                            $Faculty->update();
                                                            $this->inputs=[];
                                                            $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
                                                            return redirect()->back();
                                                        }
                                                }
                                                else
                                                {
                                                    $this->dispatchBrowserEvent('teacherOverloads-confirmation',['message'=>'From '.$this->FlastName.','.$this->FfirstName.' it will be '.$this->overloadView.' Units']);
                                                 }

                                            }
                            }else{
                                $timeCheckCountFacultys= Generate::where('teacher',  $this->teacherId)
                                ->where('weekday', $this->weekdayId)->get();
                                foreach($timeCheckCountFacultys as $conflictFaculty){
                                    $conflictStartF[] = Carbon::createFromTimeString($conflictFaculty['startTime'])->format('g:i A');
                                    $conflictEndF[] = Carbon::createFromTimeString($conflictFaculty['endTime'])->format('g:i A');
                                }
                                $getNameFaculty = Faculty::where('idNumber',$this->teacherId)->get();
                                    foreach( $getNameFaculty as $Facultys)
                                    {
                                        $FyfirstName =$Facultys['firstName'];
                                        $FylastName =$Facultys['lastName'];
                                }
                                $this->notAvailableTimesF = array_combine($conflictStartF,$conflictEndF);
                                $this->dispatchBrowserEvent('timecheckFaculty-confirmation', ['message'=>'Time Conflict To '.$FylastName.','.$FyfirstName.' at '.$this->weekdayId.' , click Ok! To see More'  ]);
                            }

                             }else{
                                        $timeCheck= Generate::where('room', $this->roomId)
                                        ->where('weekday', $this->weekdayId)->get();
                                    foreach($timeCheck as $conflict){
                                        $conflictStart[] = Carbon::createFromTimeString($conflict['startTime'])->format('g:i A');
                                        $conflictEnd[] = Carbon::createFromTimeString($conflict['endTime'])->format('g:i A');
                                    }
                                    $this->notAvailableTimes = array_combine($conflictStart,$conflictEnd);
                                    $this->dispatchBrowserEvent('timecheck-confirmation', ['message'=>'To see not available Time, click Ok!' ]);
                             }
    }else{
        $timeCheckCountStudent= Generate::where('course', $this->courseId)
        ->where('year', $this->yearId)
        ->where('section', $this->sectionId)
        ->where('weekday', $this->weekdayId)->get();
        foreach($timeCheckCountStudent as $conflict){
            $conflictStart[] = Carbon::createFromTimeString($conflict['startTime'])->format('g:i A');
            $conflictEnd[] = Carbon::createFromTimeString($conflict['endTime'])->format('g:i A');
            $courseConflict = $conflict['course'];
            $yearConflict = $conflict['year'];
            $sectionConflict = $conflict['section'];

        }
        $this->notAvailableTimesS = array_combine($conflictStart,$conflictEnd);
        $this->dispatchBrowserEvent('timecheckStudent-confirmation', ['message'=>'Time Conflict To '.$courseConflict.','.$yearConflict[0].'-'. $sectionConflict.' at '.$this->weekdayId.' , click Ok! To see More'  ]);
    }
    }
    else{
        $this->dispatchBrowserEvent('timeOverDue-confirmation',['message'=>'Your time input is Not correct']);
      }

   }else{
     $this->dispatchBrowserEvent('timeOverDue-confirmation',['message'=>'Your time input is out of the limit! Create time from 7:30AM to 7:30PM']);
   }


}


public function overloadSave()
{
    $checkSemester = Archive::where('startSchool', $this->dt - 1)->where('endSchool', ($this->dt))->where('semester','2nd')->count();
    $checkSemester2 = Archive::where('startSchool', $this->dt)->where('endSchool', ($this->dt + 1))->where('semester','1st')->count();
    if($checkSemester != 0 && $checkSemester2 != 0 )
    {
            $this->semesterId = '1st';
            $this->sCy = $this->dt;
            $this->sCe = $this->dt + 1;
    }
    elseif($checkSemester2 != 0 ){
        $this->semesterId = '2nd';
        $this->sCy = $this->dt - 1;
        $this->sCe = $this->dt;
    }else{
        $this->semesterId = '1st';
        $this->sCy = $this->dt;
        $this->sCe = $this->dt + 1;
    }
    $this->dt = Carbon::now()->isoFormat('YYYY');
    $saveStartTime = Carbon::createFromTimeString($this->startTimeId)->format('H:i');
    $saveEndTime = Carbon::createFromTimeString($this->endTimeId)->format('H:i');
    $diff = Carbon::parse( $saveStartTime)->diffInMinutes( $saveEndTime );
    $Generate = new Generate;
    $Generate->course =$this->courseId;
    $Generate->year = $this->yearId;
    $Generate->section =$this->sectionId;
    $Generate->semester = $this->semesterId;
    $Generate->subject = $this->subjectId;
    $Generate->teacher =$this->teacherId;
    $Generate->room =$this->roomId;
    $Generate->weekday =$this->weekdayId;
    $Generate->startTime =$saveStartTime;
    $Generate->endTime =$saveEndTime;
    $Generate->startSchool =$this->sCy;
    $Generate->endSchool =  $this->sCe;
    $Generate->difference =$diff;
    $Generate->created_by = auth()->user()->idNumber;
    $Generate->save();
    $Faculty = Faculty::find($this->Fid);
    $Faculty->overload = $this->tolalUnitsO ;
    $Faculty->update();
    $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
    return redirect()->back();
}

public function notAvailableTime()
{
    dd( $this->notAvailableTimes);
}
public function notAvailableTimeF()
{
    dd( $this->notAvailableTimesF);
}
public function notAvailableTimeS()
{
    dd( $this->notAvailableTimesS);
}
public function remove($i)
{
    unset($this->inputs[$i]);

}
public function updatedSelectedPageRows($value)
{
    if ($value){
        $this->selectedRows = $this->generateviews->pluck('id')->map(function($id){
            return (string) $id;
        });
    } else{
        $this->reset(['selectedRows','selectedPageRows']);
    }
}
public function filterGeneratesByCourse($courseview =null)
{
    $this->courseview =$courseview;
}
//------------Get schedule Property-----------//
public function getGenerateviewsProperty()
{
    return  Generate::when($this->courseview, function ($query){
       return $query->where('course',$this->courseview);
    })
    ->search(trim($this->search))
    ->latest()
    ->paginate(10);
}
    public function dataReset()
    {

        $this->dispatchBrowserEvent('reset-confirmation',['message'=>'Are You Sure You Want to Archive?']);

    }

    public function resetActivites()
    {
        $archiveSchedules = Generate::all();
        foreach($archiveSchedules as $archiveSchedule)
        {

            $Archive = new Archive();
            $Archive->course =$archiveSchedule->course;
            $Archive->year = $archiveSchedule->year ;
            $Archive->section = $archiveSchedule->section;
            $Archive->semester = $archiveSchedule->semester;
            $Archive->subject = $archiveSchedule->subject;
            $Archive->teacher = $archiveSchedule->teacher ;
            $Archive->room = $archiveSchedule->room;
            $Archive->weekday = $archiveSchedule->weekday;
            $Archive->startTime = $archiveSchedule->startTime;
            $Archive->endTime = $archiveSchedule->endTime ;
            $Archive->startSchool = $archiveSchedule->startSchool;
            $Archive->endSchool = $archiveSchedule->endSchool;
            $Archive->difference = $archiveSchedule->difference;
            $Archive->created_by = $archiveSchedule->created_by;
            $Archive->save();
        }
        $resetZeros = Faculty::all();
        foreach($resetZeros as $resetzero)
        {
            $this->ids = $resetzero['id'];
            $Faculty = Faculty::find($this->ids);
            $Faculty->regular = 0;
            $Faculty->overload = 0;
            $Faculty->update();
        }
        Generate::truncate();
       subjectAtendacnes::truncate();
        $this->dispatchBrowserEvent('save-generate',['message'=>'successful Archive']);
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
        $courseCount = Generate::count();
        $weekDays = Weekday::WEEK_DAYS;
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
        $showUnits = Faculty::where('idNumber',$this->teacherId)->get();
        $this->generates = Generate::where('teacher',$this->teacherId)->where('semester',$this->semesterId)->where('startSchool',$this->dt)->get();

        $users = User::all();


        return view('livewire.admin.list-generates',[
           'generateviews' => $this->generateviews,
            'generates' => $this->generates,
            'weekDays' => $weekDays,
            'timeRange' => $this->timeRange,
            'showUnits' =>  $showUnits,
            'courseCount'=> $courseCount,
            'users' => $users,

            'dt' =>  $this->dt,


        ]);
    }
}
