//-------start variable------//
            use WithPagination;
            protected $listeners = ['overrideConfirmed' => 'overrideSave','overloadsConfirmed' => 'overloadSave','timesConfirmed' =>'notAvailableTime','timesFConfirmed'=> 'notAvailableTimeF' ];
            protected $paginationTheme = 'bootstrap';
            public $state = [];
            public $course = null;
            public $now;
            public $result;
            public $subject;
            public $showEditGenerateModal = false;
            public $deleteSelectedRows = null;
            public $selectedRows =[];
            public $selectedPageRows = false;
            public $search;
            public $years;
            public $yearId;
            public $semesters;
            public $semesterId;
            public $courses;
            public $courseId;
            public $subjects;
            public $subjectId;
            public $sections;
            public $sectionId;
            public $teachers;
            public $teacherId;
            public $rooms;
            public $roomId;
            public $weekdays;
            public $weekdayId;
            public $startTimes;
            public $startTimeId;
            public $endTimes;
            public $endTimeId;
            public $startSchools;
            public $startSchoolId;
            public $endSchools;
            public $endSchoolId;
            public $generate;
       //-------end variable--------//
       
       //---------start Add New Schedule showing modal--------//
           public function addNew()
           {
               $this->showEditGenerateModal = false;
               $this->dispatchBrowserEvent('show-form');
            
           }
       //---Create schedule---//
           public function createGenerate()
           {
               $this->validatedData = Validator::make($this->state, [
                   'course' => 'required',
                   'year' => 'required',
                   'section' => 'required',
                   'semester' =>'required',
                   'subject' =>'required',
                   'teacher'=> 'required',
                   'room'=> 'required',
                   'weekday'=> 'required',
                   'startTime'=> 'required',
                   'endTime'=> 'required',
                   'startSchool'=> 'required',
               ])->validate();
                $datagenerates = $this->validatedData;
                $startTime = Carbon::createFromTimeString($datagenerates['startTime']);
                $endTime = Carbon::createFromTimeString($datagenerates['endTime']);
                $endOfTime =Carbon::parse( $endTime);
                $startOfTime =Carbon::parse($startTime);
                
                //-----time check First-----//
              if($endOfTime->between('07:00:00','19:30:00') && $startOfTime->between('07:00:00','19:30:00')){
                $eTime =Carbon::parse($endTime)->toTimeString();
                $sTime =Carbon::parse($startTime)->toTimeString();
                $timeCheckCount= Generate::where('room', $datagenerates['room'])
                ->where('weekday', $datagenerates['weekday'])
                ->where('startTime', '<=', $eTime )
                ->where('endTime','>=', $sTime)->count();
               
                if($timeCheckCount == 0){
                $timeCheckCountFaculty= Generate::where('teacher', $datagenerates['teacher'])
                ->where('weekday', $datagenerates['weekday'])
                ->where('startTime', '<=', $eTime )
                ->where('endTime','>=', $sTime)->count();
                    if( $timeCheckCountFaculty == 0){
                    $getUnitsFaculty = Faculty::where('idNumber',$datagenerates['teacher'])->get();
                     foreach( $getUnitsFaculty as $Faculty)
                    {
                        $facultyUnits =  $Faculty['units'];
                         $this->FfirstName =$Faculty['firstName'];
                      $this->FlastName =$Faculty['lastName'];
                      $this->Fid =$Faculty['id'];
                       }
                  $getUnitsSubject =Subject::where('course',$datagenerates['course'])
                  ->where('courseCode',$datagenerates['subject'])->get();
                  foreach($getUnitsSubject as $unitSubject)
                   {
                       $subjectUnits =  $unitSubject['units'];

                   }
                   $this->tolalUnits =  $subjectUnits + $facultyUnits ;
                  if(21 <  $this->tolalUnits){
                    if($this->tolalUnits > 27){
                      $this->dispatchBrowserEvent('teacherRide-confirmation',['message'=>'From '.$this->FlastName.','.$this->FfirstName.' it will be '.$this->tolalUnits.' Units']);
                    }else{
                        $this->dispatchBrowserEvent('teacherOverloads-confirmation',['message'=>'From '.$this->FlastName.','.$this->FfirstName.' it will be '.$this->tolalUnits.' Units']);
                      }
                   }else{
                    $saveStartTime = Carbon::createFromTimeString($datagenerates['startTime'])->addMinutes()->toTimeString();
                    $saveEndTime = Carbon::createFromTimeString($datagenerates['endTime'])->subMinutes()->toTimeString();
                    $Generate = new Generate;
                    $Generate->course =$datagenerates['course'];
                    $Generate->year = $datagenerates ['year'];
                    $Generate->section = $datagenerates ['section'];
                    $Generate->semester = $datagenerates ['semester'];
                    $Generate->subject = $datagenerates ['subject'];
                    $Generate->teacher =$datagenerates ['teacher'];
                    $Generate->room =$datagenerates ['room'];
                    $Generate->weekday =$datagenerates ['weekday'];
                    $Generate->startTime =$saveStartTime;
                    $Generate->endTime =$saveEndTime;
                    $Generate->startSchool =$datagenerates ['startSchool'];
                    $Generate->endSchool =$this->startSchoolId + 1;
                    $Generate->save();
                    $Faculty = Faculty::find($this->Fid);
                    $Faculty->units = $this->tolalUnits;
                    $Faculty->update();
                    $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
                     }
                    }else{ 
                        $timeCheckCountFacultys= Generate::where('teacher', $datagenerates['teacher'])
                        ->where('weekday', $datagenerates['weekday'])->get();
                        foreach($timeCheckCountFacultys as $conflictFaculty){
                            $conflictStartF[] = Carbon::createFromTimeString($conflictFaculty['startTime'])->subMinutes()->toTimeString();
                             $conflictEndF[] = Carbon::createFromTimeString($conflictFaculty['endTime'])->addMinutes()->toTimeString();
                         }
                         $getNameFaculty = Faculty::where('idNumber',$datagenerates['teacher'])->get();
                             foreach( $getNameFaculty as $Facultys)
                           {
                               $FyfirstName =$Facultys['firstName'];
                               $FylastName =$Facultys['lastName'];
                          }
                        $this->notAvailableTimesF = array_combine($conflictStartF,$conflictEndF);     
                       $this->dispatchBrowserEvent('timecheckFaculty-confirmation', ['message'=>'Time Conflict To '.$FylastName.','.$FyfirstName.' at '.$datagenerates['weekday'].' , click Ok! To see More'  ]);
                     
                    }   
                }else{
                   $timeCheck= Generate::where('room', $datagenerates['room'])
                   ->where('weekday', $datagenerates['weekday'])->get();    
               foreach($timeCheck as $conflict){
                     $conflictStart[] = Carbon::createFromTimeString($conflict['startTime'])->subMinutes()->toTimeString();
                      $conflictEnd[] = Carbon::createFromTimeString($conflict['endTime'])->addMinutes()->toTimeString();
                  }
                 $this->notAvailableTimes = array_combine($conflictStart,$conflictEnd);     
                 $this->dispatchBrowserEvent('timecheck-confirmation', ['message'=>'To see not available Time, click Ok!' ]);
                }
              }else{
                $this->dispatchBrowserEvent('timeOverDue-confirmation');
              }
                   return redirect()->back();
                 
       
           }
   
       //---------End Add New schedule modal--------//
    public function overrideSave(){
        $datagenerates = $this->validatedData;
        $saveStartTime = Carbon::createFromTimeString($datagenerates['startTime'])->addMinutes()->toTimeString();
        $saveEndTime = Carbon::createFromTimeString($datagenerates['endTime'])->subMinutes()->toTimeString();
        $Generate = new Generate;
        $Generate->course =$datagenerates['course'];
        $Generate->year = $datagenerates ['year'];
        $Generate->section = $datagenerates ['section'];
        $Generate->semester = $datagenerates ['semester'];
        $Generate->subject = $datagenerates ['subject'];
        $Generate->teacher =$datagenerates ['teacher'];
        $Generate->room =$datagenerates ['room'];
        $Generate->weekday =$datagenerates ['weekday'];
        $Generate->startTime =$saveStartTime;
        $Generate->endTime =$saveEndTime;
        $Generate->startSchool =$datagenerates ['startSchool'];
        $Generate->endSchool =$this->startSchoolId + 1;
        $Generate->save();
        $Faculty = Faculty::find($this->Fid);
        $Faculty->units = $this->tolalUnits;
        $Faculty->update();
        $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
    }

    public function overloadSave()
    {
        $dataGenerates = $this->validatedData;
        $saveStartTime = Carbon::createFromTimeString($dataGenerates['startTime'])->addMinutes()->toTimeString();
        $saveEndTime = Carbon::createFromTimeString($dataGenerates['endTime'])->subMinutes()->toTimeString();
        $Generate = new Generate;
        $Generate->course =$dataGenerates['course'];
        $Generate->year = $dataGenerates ['year'];
        $Generate->section = $dataGenerates ['section'];
        $Generate->semester = $dataGenerates ['semester'];
        $Generate->subject = $dataGenerates ['subject'];
        $Generate->teacher =$dataGenerates ['teacher'];
        $Generate->room =$dataGenerates ['room'];
        $Generate->weekday =$dataGenerates ['weekday'];
        $Generate->startTime =$saveStartTime;
        $Generate->endTime =$saveEndTime;
        $Generate->startSchool =$dataGenerates ['startSchool'];
        $Generate->endSchool =$this->startSchoolId + 1;
        $Generate->save();
        $Faculty = Faculty::find($this->Fid);
        $Faculty->units = $this->tolalUnits;
        $Faculty->update();
        $this->dispatchBrowserEvent('save-generate',['message'=>'From '.$this->FlastName.','.$this->FfirstName. 'successful save']);
    }
       
    public function notAvailableTime()
    {
        dd( $this->notAvailableTimes);
    }
    public function notAvailableTimeF()
    {
        dd( $this->notAvailableTimesF);
    }
       
    public function updateSubject()
    {
              $validatedData = Validator::make($this->state, [
               'course' => 'required|course,'.$this->subject->id,
               'courseCode' => 'required',
               'subjectName' => 'required',
               'year' =>'required',
               'semester' =>'required',
               'units'=> 'required',
       
        ])->validate();
        $this->subject->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Teacher Updated successfully!']);
        return redirect()->back();
    }
       //---------End Update show modal---------//
    public function mount()
    {
        $this->courses = Subject::orderby('course')->get();
        $this->getYears();
        $this->getSemesters();
        $this->getSubjects();
        $this->getSections();
        $this->getTeachers(); 
        $this->getRooms();
        $this->getWeekdays();
        $this->getStartTimes(); 
        $this->getEndTimes();  
        $this->getStartSchools();
        $this->getEndSchools();
    } 
    public function updatedCourseId()
    {
        $this->getYears();


    }
    public function updatedYearId()
    {
        $this->getSections();
        $this->getSemesters();
    }
    public function updateSectionId()
    {
        $this->getSemesters();
 
    }
    public function updatedSemesterId()
    {
        $this->getSubjects();

    }
    
    public function updatedSubjectId()
    {
        $this->getTeachers();

    }
    public function updatedTeacherId()
    {
        $this->getRooms();

    }
    public function updatedRoomId()
    {
        $this->getWeekdays();

    }
    public function updatedWeekdayId()
    {
        $this->getStartTimes();
        $this->getStartTimes();
        $this->getEndTimes();
        $this->getStartSchools();

    }
    public function updatedStartTimeId()
    {
 
        $this->getEndTimes();


    }
    public function updatedEndTimeId()
    {
        $this->getStartSchools();
   
 
    }
    public function updatedStartSchoolId()
    {
        $this->getEndSchools();
    }
    public function updatedEndSchoolId()
    {
        $this->getEndSchools();
    }
    public function getYears()
    {
        if ($this->courseId != ''){
            $this->years =Subject::where('course', $this->courseId)->get();
          
        }
        
        else{
            $this->years = [];
            $this->sections = [];
            $this->semesters = [];
            $this->subjects = [];
            $this->teachers = [];
            $this->rooms = [];
            $this->weekdays = [];
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];

        }
    }
    public function getSections()
    {
        if ($this->yearId != ''){
            $this->sections =Subject::where('year', $this->yearId )
            ->where('course', $this->courseId)->get();
         }
         
         else{
             $this->sections = [];
             $this->semesters = [];
             $this->subjects = [];
             $this->teachers = [];
             $this->rooms = [];
             $this->weekdays = [];
             $this->startTimes = [];
             $this->endTimes = [];
             $this->startSchools = [];
         
         }
    }
    public function getSemesters()
    {
        if ($this->sections != ''){
            $this->semesters =  $this->sections;
         }
         else{
             $this->semesters = [];
             $this->subjects = [];
             $this->teachers = [];
             $this->rooms = [];
             $this->weekdays = [];
             $this->startTimes = [];
             $this->endTimes = [];
             $this->startSchools = [];
         }
    }
    public function getSubjects()
    {
        if ($this->semesterId != ''){
            $this->subjects =Subject::where('semester', $this->semesterId)
            ->where('course',$this->courseId)
            ->where('year', $this->yearId)->get();
        }
        
        else{
            $this->subjects = [];
            $this->teachers = [];
            $this->rooms = [];
            $this->weekdays = [];
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];

        }
    }
    public function getTeachers()
    {
        $activate = 'Activated';
        if ($this->subjectId != ''){
            $this->teachers =Faculty::where('activation', $activate)->get();
        }
        
        else{
            $this->teachers = [];
            $this->rooms = [];
            $this->weekdays = [];
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];
        }
    }
    public function getRooms()
    {
        $activate = 'Active';
        if ($this->teacherId != ''){
            $role = Subject::where('semester', $this->semesterId)
            ->where('course',$this->courseId)
            ->where('year', $this->yearId)
            ->where('courseCode', $this->subjectId)
            ->pluck('role');
            $this->rooms = Room::where('available', $activate)
            ->where('role',$role)->get();
        }
        else{
            $this->rooms = [];
            $this->weekdays = [];
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];
        }
    }
    public function getWeekdays()
    {
        if ($this->roomId != ''){
            $role = Room::where('room', $this->roomId)->pluck('role');
            $this->weekdays = Weekday::where('role',$role)->get();
        }
        else{
            $this->weekdays = [];
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];
        }
    }
    public function getStartTimes()
    {
        if ($this->weekdayId != ''){
            $role = Room::where('room', $this->roomId)->pluck('role');
            $this->startTimes = Weekday::where('day',$this->weekdayId)
            ->where('role',$role)->get();
        }
        else{
            $this->startTimes = [];
            $this->endTimes = [];
            $this->startSchools = [];
        }
    }
    public function getEndTimes()
    {
        if ($this->weekdayId != ''){
            $role = Room::where('room', $this->roomId)->pluck('role');
            $this->endTimes = Weekday::where('day',$this->weekdayId)
            ->where('role',$role)->get();
        }
        else{
            $this->endTimes = [];
            $this->startSchools = [];
        }
    }
    public function getStartSchools()
    {
        if ($this->weekdayId != ''){
            $role = Room::where('room', $this->roomId)->pluck('role');
            $this->startSchools = Weekday::where('day',$this->weekdayId)
            ->where('role',$role)->get();
        }
        else{
            $this->startSchools = [];
        }
    }
    public function getEndSchools()
    {
        if ($this->startSchoolId != ''){
            $this->endSchools = $this->startSchoolId;
        }
        else{
            $this->endSchools = [];
        }
    }

//!!--------------------Start Filtering-----------------!!//
//------------Filtering By Status-----------//
public function filterGeneratesByCourse($course =null)
{
    $this->course =$course;  
}
//------------Update Selected Page Rows-----------//
public function updatedSelectedPageRows($value)
{
    if ($value){
        $this->selectedRows = $this->generates->pluck('id')->map(function($id){
            return (string) $id;
        });
    } else{
        $this->reset(['selectedRows','selectedPageRows']);
    }
}
//------------Get schedule Property-----------//
public function getGeneratesProperty()
{
    return Generate::when($this->course, function ($query){
       return $query->where('course',$this->course);
    })
    ->search(trim($this->search))
    ->latest()
    ->paginate(4);
}
//------------Delete Select Rows Confirmation-----------//
public function deleteSelectedRows()
{
    $this->dispatchBrowserEvent('deleted-confirmation');
}

//------------Delete Faculty Rows-----------//
public function deleteSubjectRows()
{
    Subject::whereIn('id',$this->selectedRows)->delete();
    $this->dispatchBrowserEvent('deleted');
    $this->reset(['selectedPageRows','selectedRows']);
}
//!!--------------------End Filtering----------------!!//

    public function render()
    {
        $generates = $this->generates;
        $courseCount = Generate::count();
        $BSISCoursesCount = Generate::where('course','BSIS')->count();
        $BSITCoursesCount = Generate::where('course','BSIT')->count();
        return view('livewire.admin.list-generates',[
            'generates' => $generates,
            'courseCount'=> $courseCount,
            'BSISCoursesCount' => $BSISCoursesCount,
            'BSITCoursesCount' =>$BSITCoursesCount,
]);
    }
    $subjectUnit = Subject::where('semester', $this->semesterId)
            ->where('course_code',$this->courseId)
            ->where('year', $this->yearId)
            ->where('subject_code',$this->subjectId)->get();
            foreach($subjectUnit as $unitSubject)
             {
                 $subjectUnits =  $unitSubject['units'];
        
             }
           $regulars = Faculty::where('idNumber',$this->teacherId)->get();
           foreach($regulars as $regularFaculty)
           {
               $facultyregular  =  $regularFaculty['regular'];
               $facultysUnits = $regularFaculty['units'];
        
           }
           $this->total =  $subjectUnits + $facultyregular;
           if( $facultysUnits != ''){
            if( $facultysUnits  <=   $facultyregular){
             dd('overload');
            }else{
            }
           }else{
            dd('no Units available');
           }