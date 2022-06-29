<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Subject;
use App\Models\Programs;
use App\Models\User;
class ListSubjects extends Component
{
       //-------start variable------//
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteSubjectRows'];
    protected $paginationTheme = 'bootstrap';
 

    public $inputs = [];
    public $i = 1;
    public $courseCode,$subjectTitle,$units,$coriculumYear,$year,$semester,$lecHours,$labHours;
    public $result;
    public $subject;
    public $showEditSubjectModal = false;
    public $deleteSelectedRows = null;
    public $selectedRows =[];
    public $selectedPageRows = false;
    public $search;
    public $courseId;
    public $course;
    public $coriculumId;
    public $coriculums;
    public $role = 'ACTIVE';
//-------end variable--------//

//---------start Add New Room showing modal--------//
    public function addNew()
    {
        $this->showEditSubjectModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
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
    private function resetInputsFields(){
        $this->courseCode = '';
        $this->subjectTitle = '';
        $this->units = '';
        $this->lecHours = '';
        $this->labHours = '';
        $this->courseId ='';
        $this->coriculumYear ='';
        $this->year ='';
        $this->semester ='';

    }
//---Create room---//
    public function createSubject()
    {
       $this->role ='ACTIVE';
        $validatedDate = $this->validate([
            'courseCode.0' => 'required',
            'subjectTitle.0' => 'required',
            'units.0' => 'required',
            'lecHours.0' => 'required',
            'labHours.0' => 'nullable',
            'courseCode.*' => 'required',
            'subjectTitle.*' => 'required',
            'units.*' => 'required',
            'lecHours.*' => 'required',
            'labHours.*' => 'nullable',
            'courseId' => 'required',
            'coriculumYear' => 'required',
            'year' =>'required',
            'semester' =>'required',
        ]);
        foreach ($this->courseCode as $key => $value){
            Subject::create([
                'subject_code' => $this->courseCode[$key],
                'subject_title' => $this->subjectTitle[$key],
                'units' => $this->units[$key],
                'lecHours' => $this->lecHours[$key],
                'labHours' => $this->labHours[$key],
                'course_code' => $this->courseId,
                'coriculum_year' => $this->coriculumYear,
                'year' => $this->year,
                'semester' => $this->semester,
                'role' => $this->role,
                'created_by' => auth()->user()->idNumber, 
              
            ]);
        }
        
        $this->inputs=[];
        $this->resetInputsFields();
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'succecful insert ']);

            return redirect()->back();

    }
//---------End Add New Room modal--------//

//---------Start Update show modal---------//
    public function edit(Subject $subject)
    {
        $this->showEditSubjectModal = true;

        $this->subject = $subject;

        $this->state = $subject->toArray();

        $this->dispatchBrowserEvent('show-form');
    }
//---------Update Room---------//
    public function updateSubject()
    {
       $validatedData = Validator::make($this->state, [
        'course' => 'required|course,'.$this->subject->id,
        'courseCode' => 'required',
        'subjectName' => 'required',
        'year' =>'required',
        'semester' =>'required',
        'units'=> 'required',
        'lecHours'=> 'required',
        'labHours'=> 'nullable',
        'changed_by' => auth()->user()->idNumber, 

        ])->validate();
        $this->subject->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Updated successfully!']);
        return redirect()->back();
    }
//---------End Update show modal---------//

//!!--------------------Start Filtering-----------------!!//
//------------Filtering By Status-----------//
    public function filterSubjectsByCourses($course = null)
    {
        $this->course =$course;  
    }
//------------Update Selected Page Rows-----------//
    public function updatedSelectedPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->subjects->pluck('id')->map(function($id){
                return (string) $id;
            });
        } else{
            $this->reset(['selectedRows','selectedPageRows']);
        }
    }
//------------Get Room Property-----------//
    public function getSubjectsProperty()
    {
        return Subject::when($this->course, function ($query){
           return $query->where('course_code',$this->course);
        })
        ->search(trim($this->search))
        ->latest()
        ->paginate(10);
    }

//!!--------------------End Filtering----------------!!//
public function mount()
{
    $this->courses = Programs::where('role','ACTIVE')->get();
    $this->getCoriculums();
} 
public function updatedCourseId()
{
    $this->getCoriculums();


}
public function getCoriculums()
{
    if ($this->courseId != ''){
        $this->coriculums =Programs::where('course_code', $this->courseId)->get();
      
    }
    else{
        $this->coriculums = [];

    }
}
//------------rendering-----------//

    public function render()
    {
        $users = User::all();
     
        $coursess = Programs::all();
        $subjects = $this->subjects;

        return view('livewire.admin.settings.list-subjects',[
            'subjects' => $subjects,
            'coursess' => $coursess,
            'users' => $users,
        ]);
    }
}
