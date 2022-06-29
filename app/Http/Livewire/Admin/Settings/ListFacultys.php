<?php

namespace App\Http\Livewire\Admin\Settings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Faculty;


class ListFacultys extends Component
{
    //-------start variable------//
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteFacultyRows'];
    protected $paginationTheme = 'bootstrap';
    public $activation =null;
    public $faculty;
    public $showEditFacultyModal = false;
    public $deleteSelectedRows = null;
    public $selectedRows =[];
    public $selectedPageRows = false;
    public $search;
//-------end variable--------//


//---------Start Update show modal---------//
    public function edit(Faculty $faculty)
    {
        $this->showViewFacultyModal = true;

        $this->faculty = $faculty;

        $this->state = $faculty->toArray();

        $this->dispatchBrowserEvent('show-form');
    }


//!!--------------------Start Filtering-----------------!!//
//------------Filtering By Status-----------//
    public function filterFacultysByActivation($activation =null)
    {
        $this->activation =$activation;
    }
//------------Update Selected Page Rows-----------//
    public function updatedSelectedPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->facultys->pluck('id')->map(function($id){
                return (string) $id;
            });
        } else{
            $this->reset(['selectedRows','selectedPageRows']);
        }
    }
//------------Get Room Property-----------//
    public function getFacultysProperty()
    {
        return Faculty::when($this->activation, function ($query){
           return $query->where('activation',$this->activation);
        })
        ->search(trim($this->search))
        ->latest()
        ->paginate(4);
    }
//------------Mark As Activated-----------//
    public function markAsActivated()
    {
        Faculty::whereIn('id', $this->selectedRows)->update(['activation'=>'ACTIVE']);
        $userChange = Faculty::whereIn('id', $this->selectedRows);
        foreach($userChange as $userChanges)
        {
            $this->ids = $userChanges['idNumber'];
            $this->roleUser = User::where('idNumber',$this->ids)->update(['role2'=>'active']);

        }




        $this->dispatchBrowserEvent('updated-active');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Mark As Deactivated-----------//
    public function markAsDeactivated()
    {
        Faculty::whereIn('id', $this->selectedRows)->update(['activation'=>'INACTIVE']);
        $userChange = Faculty::whereIn('id', $this->selectedRows)->get();
        foreach($userChange as $userChanges)
        {
            $this->ids = $userChanges['idNumber'];
            $this->roleUser = User::where('idNumber',$this->ids)->update(['role2'=>'inactive']);

        }
        $this->dispatchBrowserEvent('updated-deactive');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Delete Select Rows Confirmation-----------//
    public function deleteSelectedRows()
    {
        $this->dispatchBrowserEvent('deleted-confirmation');
    }

//------------Delete Faculty Rows-----------//
    public function deleteFacultyRows()
    {
        Faculty::whereIn('id',$this->selectedRows)->delete();
        User::whereIn('id',$this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//!!--------------------End Filtering----------------!!//

//------------rendering-----------//

    public function render()
    {
        $facultys = $this->facultys;
        $users = User::all();
        $facultyCount = Faculty::count();
        $activateFacultysCount = Faculty::where('activation','ACTIVE')->count();
        $deactivateFacultysCount = Faculty::where('activation','INACTIVE')->count();
        return view('livewire.admin.settings.list-facultys',[
            'facultys' => $facultys,
            'facultyCount'=> $facultyCount,
            'activateFacultysCount' => $activateFacultysCount,
            'deactivateFacultysCount' =>$deactivateFacultysCount,
            'users' =>  $users,
        ]);
    }
}
