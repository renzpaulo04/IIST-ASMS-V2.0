<?php

namespace App\Http\Livewire\Admin\Settings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Faculty;

class ListScheduler extends Component
{
     //-------start variable------//
     use WithPagination;
     protected $paginationTheme = 'bootstrap';
     public $status =null;
     public $scheduler;
     public $showEditFacultyModal = false;
     public $selectedRows =[];
     public $selectedPageRows = false;
     public $search;
 //-------end variable--------//


 //---------Start Update show modal---------//
     public function edit(User $scheduler)
     {
         $this->showViewSchedulerModal = true;

         $this->scheduler = $scheduler;

         $this->state = $scheduler->toArray();

         $this->dispatchBrowserEvent('show-form');
     }


 //!!--------------------Start Filtering-----------------!!//
 //------------Filtering By Status-----------//
     public function filterSchedulersByActivation($status = null)
     {
         $this->status =$status;
     }
 //------------Update Selected Page Rows-----------//
     public function updatedSelectedPageRows($value)
     {
         if ($value){
             $this->selectedRows = $this->schedulers->pluck('id')->map(function($id){
                 return (string) $id;
             });
         } else{
             $this->reset(['selectedRows','selectedPageRows']);
         }
     }
 //------------Get Room Property-----------//
     public function getSchedulersProperty()
     {
         return User::when($this->status, function ($query){
            return $query->where('status',$this->status);
         })
         ->search(trim($this->search))
         ->latest()
         ->paginate(4);
     }
 //------------Mark As Activated-----------//
     public function markAsAccepted()
     {
         User::whereIn('id', $this->selectedRows)->update(['status'=>'accept']);
         User::whereIn('id', $this->selectedRows)->update(['accepted_by'=> auth()->user()->idNumber]);
         $this->dispatchBrowserEvent('updated-active');
         $this->reset(['selectedPageRows','selectedRows']);
     }
 //------------Mark As Deactivated-----------//
     public function markAsRequesting()
     {
         User::whereIn('id', $this->selectedRows)->update(['status'=>'requesting']);
         User::whereIn('id', $this->selectedRows)->update(['accepted_by'=> auth()->user()->idNumber]);
         $this->dispatchBrowserEvent('updated-deactive');
         $this->reset(['selectedPageRows','selectedRows']);
     }

 //!!--------------------End Filtering----------------!!//

 //------------rendering-----------//
    public function render()
    {
        $schedulers = $this->schedulers;
        $users = User::all();
        $schedulerCount = User::count('status','accept' || 'status','requesting' ) ;
        $acceptedSchedulersCount =User::where('status','accept')->count();
        $requestingSchedulersCount = User::where('status','requesting')->count();
        return view('livewire.admin.settings.list-scheduler',[
            'schedulers' => $schedulers,
            'schedulerCount'=> $schedulerCount,
            'acceptedSchedulersCount' => $acceptedSchedulersCount,
            'requestingSchedulersCount' =>$requestingSchedulersCount,
            'users' =>  $users,
        ]);
    }
}
