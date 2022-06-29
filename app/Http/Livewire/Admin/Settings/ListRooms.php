<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Room;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
class ListRooms extends Component
{
//-------start variable------//
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteRoomRows'];
    protected $paginationTheme = 'bootstrap';
    public $inputs = [];
    public $i = 1;
    public $availableS,$roomS;
    public $available =null;
    public $state = [];
    public $room;
    public $showEditModal = false;
    public $deleteSelectedRows = null;
    public $search;
    public $selectedRows =[];
    public $selectedPageRows = false;
//-------end variable--------//
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

//---------start Add New Room showing modal--------//
    public function addNew()
    {
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    private function resetInputsFields(){
        $this->roomS = '';
        $this->availableS = '';
    }
//---Create room---//
    public function createRoom()
    {
       
        $validatedDate = $this->validate([
            'roomS.0' => 'required',
            'availableS.0' => 'required',
            'roomS.*' => 'required',
            'availableS.*' => 'required',
        ]);
        foreach ($this->roomS as $key => $value){
            Room::create([
                'room' => $this->roomS[$key],
                'available' => $this->availableS[$key],
                'created_by' => auth()->user()->idNumber, 
              
            ]);
        }
        $this->inputs=[];
        $this->resetInputsFields();
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Room added successfully!']);

        return redirect()->back();

    }
//---------End Add New Room modal--------//

//---------Start Update show modal---------//
    public function edit(Room $room)
    {
        $this->showEditModal = true;

        $this->room = $room;

        $this->state = $room->toArray();

        $this->dispatchBrowserEvent('show-form');
    }
//---------Update Room---------//
    public function updateRoom()
    {
        $user = ['changed_by' => auth()->user()->idNumber];
       $validatedData = Validator::make($this->state, [
        'room' => 'required|unique:rooms,room,'.$this->room->id,
        ])->validate();
        $this->room->update($validatedData);
        $this->room->update($user);
       

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'Room Updated successfully!']);
        return redirect()->back();
    }
//---------End Update show modal---------//

//!!--------------------Start Filtering-----------------!!//
//------------Filtering By Status-----------//
    public function filterRoomsByAvailable($available =null)
    {
        $this->available =$available;  
    }

//------------Update Selected Page Rows-----------//
    public function updatedSelectedPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->rooms->pluck('id')->map(function($id){
                return (string) $id;
            });
        } else{
            $this->reset(['selectedRows','selectedPageRows']);
        }
    }
//------------Get Room Property-----------//
    public function getRoomsProperty()
    {
        return Room::when($this->available, function ($query){
            return $query->where('available',$this->available);
        })
 
        ->search(trim($this->search))
        ->latest()
        ->paginate(4);
    }
//------------Mark As Activated-----------//
    public function markAsActive()
    {
        Room::whereIn('id', $this->selectedRows)->update(['available'=>'ACTIVE']);
        Room::whereIn('id', $this->selectedRows)->update(['changed_by' =>  auth()->user()->idNumber]);
        $this->dispatchBrowserEvent('updated-active');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Mark As Deactivated-----------//
    public function markAsDeactive()
    {
        Room::whereIn('id', $this->selectedRows)->update(['available'=>'INACTIVE']);
        Room::whereIn('id', $this->selectedRows)->update(['changed_by' =>  auth()->user()->idNumber]);
        $this->dispatchBrowserEvent('updated-deactive');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//------------Delete Select Rows Confirmation-----------//
    public function deleteSelectedRows()
    {
        $this->dispatchBrowserEvent('deleted-confirmation');
    }

//------------Delete Room Rows-----------//
    public function deleteRoomRows()
    {
        Room::whereIn('id',$this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted');
        $this->reset(['selectedPageRows','selectedRows']);
    }
//!!--------------------End Filtering----------------!!//

//------------rendering-----------//
    public function render()
    {
        $users = User::all();
        $rooms = $this->rooms;
        $roomCount = Room::count();
        $activeRoomsCount = Room::where('available','ACTIVE')->count();
        $deactiveRoomsCount = Room::where('available','INACTIVE')->count();
        return view('livewire.admin.settings.list-rooms',[
            'rooms' => $rooms,
            'roomCount'=> $roomCount,
            'activeRoomsCount' => $activeRoomsCount,
            'deactiveRoomsCount' =>$deactiveRoomsCount,
            'users' => $users,
        ]);
    }
}
