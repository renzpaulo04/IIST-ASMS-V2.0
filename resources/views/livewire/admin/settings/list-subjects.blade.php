<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Subject
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Subject List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Add Subject Data
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
                    <label class=" mr-1 text-secondary" >By subject:  </label>
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
                                <th> Coriculum Year</th>
                                <th> Course code</th>
                                <th> Course Title</th>
                                <th> Units </th>
                                <th> Lec Hours </th>
                                <th> Lab Hours</th>
                                <th> Year </th>
                                <th> Semester </th>
                                <th> Created By</th>
                                <th> Changed By</th>
                                <th> Status </th>
                                <th> Edit </th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($subjects->isnotEmpty()) 
                            @foreach($subjects as $subject)
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$subject->id}}" name="todo2" id="{{$subject->id}}">
                                        <label for="{{$subject->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$subject->course_code}}</td>
                                <td>{{$subject->coriculum_year}}</td>
                                <td>{{$subject->subject_code}}</td>
                                <td>{{$subject->subject_title}}</td>
                                <td>{{$subject->units}}</td>
                                <td>{{$subject->lecHours}}</td>
                                <td>{{$subject->labHours}}</td>
                                <td>{{$subject->year}}</td>
                                <td>{{$subject->semester}}</td>
                                @if($user = $users->where('idNumber',$subject->created_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                @if($user = $users->where('idNumber',$subject->changed_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                <td>
                                    <span class="badge badge-{{$subject->subjects_badge}}">{{$subject->role}}</span>
                                </td>
                                <td><a href="" ><i wire:click.prevent="edit({{$subject}})" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr> 
                           <td colspan="14" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                @endif 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    {{$subjects->links()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<!----------Start Modal for adding Room and editting Room -------->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditSubjectModal ? 'updateSubject': 'createSubject' }}">
                <div class="modal-content">
                    @if($showEditSubjectModal)
                    <div class="modal-header bg-gradient-info">
                    @else
                    <div class="modal-header bg-gradient-primary">
                     @endif
                    <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditSubjectModal)
                        <span>Edit Subject</span>
                    @else
                        <span>Add New Subject</span>
                    @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="control-group">
                    <div class="row">
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label >Program Code </label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label >Coriculum Year </label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label>Year</label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label>semester</label>
                            </div>
                    </div>
                    </div>
                    <div class="control-group">
                        <div class="row ">
                            <div class="col-xs-2 col-md-3 mb-6">
                                <select wire:model="courseId" name="courseId"class="form-control  @error('courseId') is-invalid @enderror"> 
                                <option>--Select Course--</option> 
                                @foreach ($courses as $course)
                                    <option value='{{$course->course_code}}'>{{$course->course_code}}</option>
                                @endforeach
                                </select>
                                @error('courseId')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                            </div>

                              
                                 <div class="col-xs-2 col-md-3 mb-6">
                                  <select wire:model="coriculumYear" name="coriculumYear" class="form-control @error('coriculumYear') is-invalid @enderror" >
                                 <option>--Select coriculum year--</option>
                                 @foreach ($coriculums as $coriculum)
                                 <option value='{{$coriculum->coriculum_year}}'>{{$coriculum->coriculum_year}}</option>
                                 @endforeach
                                 </select>
                                 @error('coriculumYear')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                 </div>

                                 
                                <div class="col-xs-2 col-md-3 mb-6">
                                 <select  wire:model="year" name="year" class="form-control @error('year') is-invalid @enderror">
                                    <option>--Select Year --</option> 
                                    <option value="1st">1st</option> 
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>  
                                    <option value="4th">4th</option>   
                                </select>
                                                    @error('year')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-xs-2 col-md-3 mb-8">
                                                <select   wire:model="semester" name="semester" class="form-control @error('semester') is-invalid @enderror">
                                                    <option>--Select Semester --</option> 
                                                    <option value="1st">1st</option> 
                                                    <option value="2nd">2nd</option>
                                                </select>
                                                @error('semester')
                                                    <div class="invalid-feedback">
                                                    {{$message}}
                                                    </div>
                                                @enderror
                                            </div>  
                                          
                        </div>
                    </div>
                    <div class="control-group">
                    <div class="row mt-4">
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label >Course Code </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label >Course Title </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Units</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Lec hours</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Lab hours</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Add More </label>
                            </div>
                    </div>
                    </div>
                        <div class="control-group">
                        <div class="row">
                        <div class="col-xs-2 col-md-2 mb-6">
   
                            <input  type="text" wire:model="courseCode.0" name="courseCode" class="form-control @error('courseCode.0') is-invalid @enderror" placeholder="Enter Course Code">
                            @error('courseCode.0')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="text" wire:model.defer="subjectTitle.0" name="subjectName" class="form-control @error('subjectTitle.0') is-invalid @enderror" placeholder="Enter Course Title">
                            @error('subjectTitle.0')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="units.0" name="units" class="form-control @error('units.0') is-invalid @enderror" placeholder="Enter Units">
                            @error('units.0')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="lecHours.0" name="lecHours" class="form-control @error('lecHours.0') is-invalid @enderror" placeholder="Enter Lec Hours">
                            @error('lecHours.0')
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="labHours.0" name="labHours" class="form-control @error('labHours.0') is-invalid @enderror" placeholder="Enter Lab Hours">
                            @error('labHours.0')
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
                        <div class="col-md-2 col-md-2 mb-6">
                            <input  type="text" wire:model="courseCode.{{$value}}" name="courseCode" class="form-control @error('courseCode.'.$value) is-invalid @enderror" placeholder="Enter Subject Code" required>
                            @error('courseCode.'.$value)
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                   
                            <input  type="text" wire:model.defer="subjectTitle.{{$value}}" name="subjectTitle" class="form-control @error('subjectTitle.'.$value) is-invalid @enderror" placeholder="Enter Subject Title" required>
                            @error('subjectTitle.'.$value)
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-xs-2 col-md-2 mb-6">

                            <input  type="number" wire:model.defer="units.{{$value}}" name="units" class="form-control @error('units.'.$value) is-invalid @enderror" placeholder="Enter Units" required>
                            @error('units.'.$value)
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="lecHours.{{$value}}" name="lecHours" class="form-control @error('lecHours.'.$value) is-invalid @enderror" placeholder="Enter Lec Hours">
                            @error('lecHours.'.$value)
                                <div class="invalid-feedback">
                                   {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="labHours.{{$value}}" name="labHours" class="form-control @error('labHours.'.$value) is-invalid @enderror" placeholder="Enter Lab Hours">
                            @error('labHours.'.$value)
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
                    <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        @if($showEditSubjectModal)
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