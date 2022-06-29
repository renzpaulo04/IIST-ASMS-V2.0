<div>
    <!--- start room display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Create Prospectus
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Create Prospectus</li>
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
       Add Prospectus Data
    </button>
    @if ($selectedRows)
    <button wire:click.prevent="markAsActive" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Active</button>
    <button wire:click.prevent="markAsInactive" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as inactive</button>

    <span class="ml-2">Selected {{count($selectedRows)}} {{Str::plural('program', count($selectedRows))}}</span>  
    @endif
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterProgramsByRoles" type="button" class="btn {{is_null($role) ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info">{{$roleCount}}</span>
        </button>
        <button id="active"wire:click="filterProgramsByRoles('ACTIVE')"type="button" class="btn {{($role == 'ACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Active</span>
            <span class="badge badge-pill badge-success">{{$activeRoleCount}}</span>
        </button>
        <button id="deactive" wire:click="filterProgramsByRoles('INACTIVE')"type="button" class="btn {{($role == 'INACTIVE') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">Inactive</span>
            <span class="badge badge-pill badge-primary">{{$inactiveRoleCount}}</span>
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
                    <label class=" mr-1 text-secondary" >By Program Name:  </label>
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
                                <th> Program code</th>
                                <th> Program Title </th>
                                <th> Currriculum Year</th>
                                <th> Created By</th>
                                <th> Updated By</th>
                                <th> Status</th>
                                <th> Update </th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($programs->isnotEmpty()) 
                            @foreach($programs as $program)
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$program->id}}" name="todo2" id="{{$program->id}}">
                                        <label for="{{$program->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$program->course_code}}</td>
                                <td>{{$program->course_title}}</td>
                                <td>{{$program->coriculum_year}}</td>
                                @if($user = $users->where('idNumber',$program->created_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                @if($user = $users->where('idNumber',$program->changed_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                <td>
                                    <span class="badge badge-{{$program->programs_badge}}">{{$program->role}}</span>
                                </td>
                                <td><a href="" ><i wire:click.prevent="edit({{$program}})" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr> 
                           <td colspan="8" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                @endif 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    {{$programs->links()}}
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
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateProgram': 'createProgram' }}">
            <div class="modal-content">
            @if($showEditModal)
                <div class="modal-header bg-gradient-info">
                @else
                <div class="modal-header bg-gradient-primary">
                @endif
                    <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditModal)
                        <span>Edit course</span>
                    @else
                        <span>Add New Prospectus</span>
                    @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        <div class="control-group">
                            <label>Program Code</label>
                            <input  type="text" wire:model.defer="state.course_code" name="course_code" class="form-control @error('course_code') is-invalid @enderror" placeholder="Enter Program Code">
                            @error('course_code')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                            
                        </div>
                        <div class="control-group">
                            <label>Program Name</label>
                            <input  type="text" wire:model.defer="state.course_title" name="course_title" class="form-control @error('course_title') is-invalid @enderror" placeholder="Enter Program Title">
                            @error('course_title')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                            
                        </div>
                        <div class="control-group">
                            <label>Curriculum Year</label>
                            <input  type="text" wire:model.defer="state.coriculum_year" name="coriculum_year" class="form-control @error('coriculum_year') is-invalid @enderror" placeholder="Enter Coriculum year">
                            @error('coriculum_year')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group">
                            <label>Status</label>
                            <select id="role" wire:model.defer="state.role" name="status" class="form-control @error('role') is-invalid @enderror">
                                <option>--Select Role--</option> 
                                <option value="ACTIVE">active</option> 
                                <option value="INACTIVE">inactive</option>    
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>

                        
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addProgram" class="btn btn-primary" value="addProgram"><i class="fa fa-save mr-1"></i>
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
