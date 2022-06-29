<div>
<!--- start room display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Room
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Room List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- button fucntion for Room -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Add Room Data
    </button>
    @if ($selectedRows)
    <button wire:click.prevent="deleteSelectedRows" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash mr-1"></i>Delete Selected</button>
    <button wire:click.prevent="markAsActive" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Active</button>
    <button wire:click.prevent="markAsDeactive" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Inactive</button>

    <span class="ml-2">Selected {{count($selectedRows)}} {{Str::plural('room', count($selectedRows))}}</span>  
    @endif
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterRoomsByAvailable" type="button" class="btn {{is_null($available) ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info">{{$roomCount}}</span>
        </button>
        <button id="active"wire:click="filterRoomsByAvailable('ACTIVE')"type="button" class="btn {{($available == 'ACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Active</span>
            <span class="badge badge-pill badge-success">{{$activeRoomsCount}}</span>
        </button>
        <button id="deactive" wire:click="filterRoomsByAvailable('INACTIVE')"type="button" class="btn {{($available == 'INACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Inactive</span>
            <span class="badge badge-pill badge-primary">{{$deactiveRoomsCount}}</span>
        </button>
    </div>
    </div>
</div>
<!----------End button fucntion for Room -------->

<!----------Start Table for Room -------->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >By Room Name:  </label>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input  wire:model="search" type="text" name="table_search" class="form-control float-right fas fa-search input-group-sm" placeholder="Search">
                    </div>
                </div>
                </div>
        </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> Room Name </th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th> Update </th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($rooms->isnotEmpty()) 
                            @foreach($rooms as $room)
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$room->id}}" name="todo2" id="{{$room->id}}">
                                        <label for="{{$room->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$room->room}}</td>

                                <td>
                                    <span class="badge badge-{{$room->rooms_badge}}">{{$room->available}}</span>
                                </td>
                                @if($user = $users->where('idNumber',$room->created_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                @if($user = $users->where('idNumber',$room->changed_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                <td><a href="" ><i wire:click.prevent="edit({{$room}})" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr> 
                           <td colspan="6" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                @endif 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    {{$rooms->links()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!----------End Table for Room -------->

<!----------Start Modal for adding Room and editting Room -------->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateRoom': 'createRoom' }}">
            <div class="modal-content">
            @if($showEditModal)
                <div class="modal-header bg-gradient-info">
                @else
                <div class="modal-header bg-gradient-primary">
                @endif
                    <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditModal)
                        <span>Edit Room</span>
                    @else
                        <span>Add New Room</span>
                    @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                

                <div class="modal-body">
                <div class ="row">
                <div class="control-group">
                <label>Room Name</label>
                </div>
                </div>
                    
                    <div class="control-group">
                        <div class ="row">
                        <div class="col-xs-2 col-md-5 mb-6"> 
                            <input  type="text" wire:model.defer="roomS.0" name="roomS" class="form-control @error('roomS.0') is-invalid @enderror" placeholder="Enter Room Name">
                            @error('roomS.0')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>  
                        <div class="col-xs-2 col-md-5 mb-6">
                                 <select  wire:model="availableS.0" name="available" class="form-control @error('availableS.0') is-invalid @enderror">
                                    <option>--Select availabilty --</option> 
                                    <option value="ACTIVE">ACTIVE</option> 
                                    <option value="INACTIVE">INACTIVE</option>  
                                </select>
                                                    @error('availableS.0')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                        <button wire:click.prevent="add({{$i}})" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                        </div>
                        </div>
                    </div>
                        
                        @foreach($inputs as $key => $value)
                        <div class="control-group">
                        <div class="row mt-2">
                        <div class="col-md-2 col-md-5 mb-6">
                            <input  type="text" wire:model="roomS.{{$value}}" name="room" class="form-control @error('room.'.$value) is-invalid @enderror" placeholder="Enter Room Name" required>
                            @error('roomS.'.$value)
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-5 mb-6">
                                 <select  wire:model="availableS.{{$value}}" name="available" class="form-control @error('availableS.{{$value}}') is-invalid @enderror">
                                    <option>--Select availabilty --</option> 
                                    <option value="ACTIVE">ACTIVE</option> 
                                    <option value="INACTIVE">INACTIVE</option>  
                                </select>
                                                    @error('availableS.{{$value}}')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <button class="btn btn-danger" wire:click.prevent="remove({{$key}})"><i class="fa fa-times-circle mr-1"></i></button>
                        </div>
                        </div>
                        </div>
                        @endforeach
                        </div>
                    
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addRoom" class="btn btn-primary" value="addRoom"><i class="fa fa-save mr-1"></i>
                        @if($showEditModal)
                        <span>Save Change</span>
                    @else
                        <span>Save</span>
                    @endif
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<!----------End Modal for adding Room and editting Room -------->
</div>