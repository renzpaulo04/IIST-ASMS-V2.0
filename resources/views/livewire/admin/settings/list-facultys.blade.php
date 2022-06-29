<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Faculty
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Faculty List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    @if ($selectedRows)
    <button wire:click.prevent="deleteSelectedRows" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash mr-1"></i>Delete Selected</button>
    <button wire:click.prevent="markAsActivated" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Active</button>
    <button wire:click.prevent="markAsDeactivated" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Inactive</button>

    <span class="ml-2">Selected {{count($selectedRows)}} faculty {{Str::plural('member', count($selectedRows))}}</span>  
    @endif
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterFacultysByActivation" type="button" class="btn {{is_null($activation) ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info">{{$facultyCount}}</span>
        </button>
        <button id="active"wire:click="filterFacultysByActivation('ACTIVE')"type="button" class="btn {{($activation == 'ACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Active</span>
            <span class="badge badge-pill badge-success">{{$activateFacultysCount}}</span>
        </button>
        <button id="deactive" wire:click="filterFacultysByActivation('INACTIVE')"type="button" class="btn {{($activation == 'INACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Inactve</span>
            <span class="badge badge-pill badge-primary">{{$deactivateFacultysCount}}</span>
        </button>
    </div>
    </div>
</div>
<!----------End button fucntion for faculty -------->

<!----------Start Table for faculty -------->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >By Facutly Name:  </label>
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
                                <th> Id Number</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th> Middle Name</th>
                                <th> Email</th>
                                <th> Designation </th>
                                <th> Regular</th>
                                <th> Overload</th>
                                <th> Status </th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($facultys->isnotEmpty()) 
                            @foreach($facultys as $faculty)
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$faculty->id}}" name="todo2" id="{{$faculty->id}}">
                                        <label for="{{$faculty->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$faculty->idNumber}}</td>
                                <td>{{$faculty->firstName}}</td>
                                <td>{{$faculty->lastName}}</td>
                                <td>{{$faculty->middleName}}</td>
                                <td>{{$faculty->email}}</td>
                                <td>{{$faculty->units}}</td>
                                <td>{{$faculty->regular}}</td>
                                <td>{{$faculty->overload}}</td>
                                <td>
                                    <span class="badge badge-{{$faculty->activation_badge}}">{{$faculty->activation}}</span>
                                </td>
                               
                 
                            </tr>
                           
                            @endforeach
                            @else
                            <tr> 
                           <td colspan="10" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                @endif 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    {{$facultys->links()}}
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


</div>