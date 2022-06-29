<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Programs;
use App\Models\Subject;
use App\Models\User;

class ListCourses extends Component
{
    //-------start variable------//
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteRoomRows'];
    protected $paginationTheme = 'bootstrap';
    public $role =null;
    public $state = [];
    public $program;
    public $showEditModal = false;
    public $deleteSelectedRows = null;
    public $search;
    public $selectedRows =[];
    public $selectedPageRows = false;
//-------end variable--------//

//---------start Add New Room showing modal--------//
    public function addNew()
    {
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
//---Create program---//
    public function createProgram()
    {
        $validatedData = Validator::make($this->state, [
            'course_code' => 'required',
            'course_title' => 'required',
            'coriculum_year' =>'required',
            'role' => 'required',

        ])->validate();


        Programs::create([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'coriculum_year' => $validatedData['coriculum_year'],
            'role' => $validatedData['role'],
            'created_by' => auth()->user()->idNumber,

        ]);
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Added successfully! You can now start create an subjects']);

        return redirect()->back();

    }
//---------End Add New Room modal--------//

//---------Start Update show modal---------//
    public function edit(Programs $program)
    {
        $this->showEditModal = true;

        $this->program = $program;

        $this->state = $program->toArray();

        $this->dispatchBrowserEvent('show-form');
    }
//---------Update Room---------//
    public function updateProgram()
    {
       $validatedData = Validator::make($this->state, [
        'course_code' => 'required|same:course_code,'.$this->program->id,
        'course_title' => 'required',
        'coriculum_year' =>'required',
        'role' =>'required',
        ])->validate();
        $this->program->update($validatedData);


        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Program Updated successfully!']);
        return redirect()->back();
    }
//---------End Update show modal---------//

//!!--------------------Start Filtering-----------------!!//
//------------Filtering By Status-----------//

//------------Filtering By Roles-----------//
    public function filterProgramsByRoles($role =null){
        $this->role =$role;
    }
//------------Update Selected Page Rows-----------//
    public function updatedSelectedPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->programs->pluck('id')->map(function($id){
                return (string) $id;
            });
        } else{
            $this->reset(['selectedRows','selectedPageRows']);
        }
    }
//------------Get Room Property-----------//
    public function getProgramsProperty()
    {
        return programs::when($this->role, function ($query){
            return $query->where('role',$this->role);
        })
        ->search(trim($this->search))
        ->latest()
        ->paginate(4);
    }
//------------Mark As Activated-----------//
    public function markAsActive()
    {   $programId = Programs::whereIn('id', $this->selectedRows)->pluck('course_code');
        $programsId = Programs::whereIn('id', $this->selectedRows)->pluck('coriculum_year');
        Programs::whereIn('id', $this->selectedRows)->update(['role'=>'ACTIVE']);
        Programs::whereIn('id', $this->selectedRows)->update(['changed_by' =>  auth()->user()->idNumber]);
        Subject::whereIn('course_code',$programId)
        ->whereIn('coriculum_year',$programsId)
        ->update(['role'=>'ACTIVE']);
        Subject::whereIn('course_code',$programId)
        ->whereIn('coriculum_year',$programsId)
        ->update(['changed_by' =>  auth()->user()->idNumber]);
        $this->dispatchBrowserEvent('updated-active', ['message'=> 'Successfully Changed!']);
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Mark As Deactivated-----------//
    public function markAsInactive()
    {
        $programId = Programs::whereIn('id', $this->selectedRows)->pluck('course_code');
        $programsId = Programs::whereIn('id', $this->selectedRows)->pluck('coriculum_year');
        Programs::whereIn('id', $this->selectedRows)->update(['role'=>'INACTIVE']);
        Programs::whereIn('id', $this->selectedRows)->update(['changed_by' =>  auth()->user()->idNumber]);
        Subject::whereIn('course_code',$programId)
        ->whereIn('coriculum_year',$programsId)
        ->update(['role'=>'INACTIVE']);
        Subject::whereIn('course_code',$programId)
        ->whereIn('coriculum_year',$programsId)
        ->update(['changed_by' =>  auth()->user()->idNumber]);

        $this->dispatchBrowserEvent('updated-deactive', ['message'=> 'Successfully Changed!']);
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Delete Select Rows Confirmation-----------//
    public function deleteSelectedRows()
    {
        $this->dispatchBrowserEvent('deleted-confirmation');
    }

//------------Delete Room Rows-----------//
    public function deleteProgramsRows()
    {
        Programs::whereIn('id',$this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//!!--------------------End Filtering----------------!!//

    public function render()
    {
        $users = User::all();
        $programs = $this->programs;
        $roleCount = Programs::count();
        $activeRoleCount =Programs::where('role','ACTIVE')->count();
        $inactiveRoleCount =Programs::where('role','INACTIVE')->count();
        return view('livewire.admin.settings.list-courses',[
        'activeRoleCount' =>$activeRoleCount,
        'inactiveRoleCount' =>$inactiveRoleCount,
        'roleCount' =>$roleCount,
        'programs' =>$programs,
        'users' => $users,
    ]);
    }
}
