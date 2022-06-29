<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Attendance
                </h1>
            </div>
            </button>
     
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('faculty.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                    <li class="breadcrumb-item active">{{$semesters}} Semester / {{$dt}} School Year</li>



                </ol>

            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    @if ($selectedRows)
    <button wire:click.prevent="markAsPresent" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Present</button>
    <button wire:click.prevent="markAsLate" class="btn btn-outline-warning btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Late</button>
    <button wire:click.prevent="markAsAbsent" class="btn btn-outline-danger btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Absent</button>

    <span class="ml-2">Selected {{count($selectedRows)}} {{Str::plural('student', count($selectedRows))}}</span>  
    @endif
    </div>
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">


            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link {{$activeC}} " wire:click.prevent="c_attendance" href="#create_attendance" data-toggle="tab">Create Class Attendance</a></li>
                  <li class="nav-item"><a class="nav-link {{$activeS}} "wire:click.prevent="s_attendance" href="#student_attendance" data-toggle="tab">Class Attendance Scan By ID</a></li>
                  <li class="nav-item"><a class="nav-link {{$activeM}} "wire:click.prevent="m_attendance" href="#manual_attendance" data-toggle="tab">Class Attendance Manual</a></li>
                </ul>


              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <div class="{{$activeC}} tab-pane" id="create_attendance">
                  <form class="form-horizontal">
                    <div class="row">

                    <div class="col-xs-3 col-md-1 mb-2">
                        <label for="inputName" class="col-form-label">Section</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionId" class="form-control" required>
                        <option value="">--Select Section--</option>
                        @foreach ($sections as $section)
                                        @if($section->section == 'A')
                                        <option value='A'>A</option>
                                        @break
                                        @endif
                                @endforeach
                                @foreach ($sections as $section)
                                @if($section->section == 'B')
                                        <option value='B'>B</option>
                                        @break
                                @endif
                                @endforeach

                                @foreach ($sections as $section)
                                @if($section->section == 'C')
                                        <option value='C'>C</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sections as $section)
                                @if($section->section == 'D')
                                        <option value='D'>D</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sections as $section)
                                @if($section->section == 'E')
                                        <option value='E'>E</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sections as $sectiont)
                                @if($sectiont->section == 'F')
                                        <option value='F'>F</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sections as $section)
                                @if($section->section == 'G')
                                        <option value='G'>G</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sections as $section)
                                @if($section->section == 'H')
                                        <option value='H'>H</option>
                                        @break
                                @endif
                                @endforeach

                        </select>
                    </div>
                    <div class="col-xs-3 col-md-1 mb-2">
                        <label for="inputName" class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectId" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        @foreach($subjects as $subject)
                        <option value='{{$subject->subject}}'>{{$subject->subject}}</option>
                        @endforeach
                        </select>

                    </div>
                    </div>



                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Student Id No.</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >last Name</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>First Name</label>
                            </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="IdNumberId.0" class="form-control  @error('IdNumberId.0') is-invalid @enderror" id="inputName" placeholder="Id Number">
                            @error('IdNumberId.0')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="lastNameId.0" class="form-control  @error('lastNameId.0') is-invalid @enderror" id="inputName" placeholder="Last Name">
                            @error('lastNameId.0')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="firstNameId.0"  class="form-control @error('firstNameId.0') is-invalid @enderror" id="inputName" placeholder="First Name">
                            @error('firstNameId.0')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                         <button wire:click.prevent="add({{$i}})" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                            </div>
                    </div>
                    </div>

                    @foreach($inputs as $key => $value)
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="IdNumberId.{{$value}}" class="form-control  @error('IdNumberId.'.$value) is-invalid @enderror"  placeholder="Id Number">
                            @error('IdNumberId.'.$value)
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="lastNameId.{{$value}}" class="form-control  @error('lastNameId.'.$value) is-invalid @enderror" placeholder="Last Name">
                            @error('lastNameId.'.$value)
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                        </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="firstNameId.{{$value}}"  class="form-control  @error('firstNameId.'.$value) is-invalid @enderror" placeholder="First Name">
                            @error('firstNameId.'.$value)
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                        </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <button class="btn btn-danger" wire:click.prevent="remove({{$key}})"><i class="fa fa-times-circle mr-1"></i></button>
                        </div>
                    </div>
                    </div>

                    @endforeach
                    </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="submit" wire:click.prevent="createStudent" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                        </button>

                    </div>

                    </form>
                </div>

                <div class="{{$activeS}} tab-pane" id="student_attendance">
                  <form class="form-horizontal">
                  <div class="row">

                     <div class="col-xs-3 col-md-1 mb-2">
                        <label  class="col-form-label">Section</label>
                        </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionIds" class="form-control" required>
                        <option value="">--Select Section--</option>
                        @foreach ($sectionstimes as $sectionstime)
                                        @if($sectionstime->section == 'A')
                                        <option value='A'>A</option>
                                        @break
                                        @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'B')
                                        <option value='B'>B</option>
                                        @break
                                @endif
                                @endforeach

                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'C')
                                        <option value='C'>C</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'D')
                                        <option value='D'>D</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'E')
                                        <option value='E'>E</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'F')
                                        <option value='F'>F</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'G')
                                        <option value='G'>G</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'H')
                                        <option value='H'>H</option>
                                        @break
                                @endif
                                @endforeach

                        </select>
                    </div>
                        <div class="col-xs-3 col-md-1 mb-2">
                        <label class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectIds" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        @foreach($subjectstimes as $subjectstime)
                        <option value='{{$subjectstime->subject}}'>{{$subjectstime->subject}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                    <label class=" col-form-label float-right">Room:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="text" wire:model="roomId" class="form-control" placeholder="Input Room" required>
                    </div>
                    </div>


                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="table-responsive-md">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                           <th with='125'>Student Name</th>
                           <th>Time Start</th>
                           <th>Time End</th>
                           <th>Attendance</th>
                        </thead>
                        <tbody>
         
                        </tbody>
                    </table>


                    <div class="modal-footer mt-4">
                        <button type="submit"  name="addFaculty" class="btn btn-success" value="addFaculty"><i ></i>
                        <span>Start</span>
                        </button>
                        <button type="submit"  name="addFaculty" class="btn btn-danger" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Stop</span>
                        </button>
                    </div>

                      </div>
                      </div>
                    </form>
                </div>
                </div>
                  <!-- /.tab-pane -->
                  <div class="{{$activeM}} tab-pane" id="manual_attendance">
                  <form class="form-horizontal">
                  <div class="row">

                     <div class="col-xs-3 col-md-1 mb-2">
                        <label  class="col-form-label">Section</label>
                        </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionIds" class="form-control" required>
                        <option value="">--Select Section--</option>
                        @foreach ($sectionstimes as $sectionstime)
                                        @if($sectionstime->section == 'A')
                                        <option value='A'>A</option>
                                        @break
                                        @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'B')
                                        <option value='B'>B</option>
                                        @break
                                @endif
                                @endforeach

                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'C')
                                        <option value='C'>C</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'D')
                                        <option value='D'>D</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'E')
                                        <option value='E'>E</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'F')
                                        <option value='F'>F</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'G')
                                        <option value='G'>G</option>
                                        @break
                                @endif
                                @endforeach
                                @foreach ($sectionstimes as $sectionstime)
                                @if($sectionstime->section == 'H')
                                        <option value='H'>H</option>
                                        @break
                                @endif
                                @endforeach

                        </select>
                    </div>
                        <div class="col-xs-3 col-md-1 mb-2">
                        <label class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectIds" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        @foreach($subjectstimes as $subjectstime)
                        <option value='{{$subjectstime->subject}}'>{{$subjectstime->subject}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-xs-3 col-md-1 mb-2">
                    <label class=" col-form-label float-right">Room:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="text" wire:model="roomId" class="form-control" placeholder="Input Room" required>
                    </div>
                    <div class="col-xs-3 col-md-1 mb-2">
                    <label class=" col-form-label float-right">week:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="number" wire:model="weekId" class="form-control" placeholder="Input Week" required>
                    </div>
                    </div>


                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="table-responsive-md">
                 
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                           <th with='125'>Student Name</th>
                           <th>Attendance</th>
                        </thead>
                    
                 
                        <tbody wire:model="tablePages">
               
                        @foreach($students as $student)
                            <tr>

                                <th>
                                <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$student->id}}" name="todo2" id="{{$student->id}}">
                                        <label for="{{$student->id}}"></label>
                                    </div>
                                </th>
                                <td value="{{$student->idNumber}}">{{ucfirst(trans($student->lastName))}}, {{ucfirst(trans($student->firstName))}}</td>
                                <td value="{{$student->attendance}}"> <span class="badge badge-{{$student->Attendance_badge}}">{{$student->attendance}}</span></td>
                
                               
                            </tr>
                           
                            @endforeach
                        </tbody>
                        
                    </table>
                  

                    <div class="modal-footer mt-4">
                        <button type="submit" wire:click.prevent="saveAttendance" name="addFaculty" class="btn btn-success" value="addFaculty"><i ></i>
                        <span>Save</span>
                        </button>
                    </div>

                      </div>
                      </div>
                    </form>
               
                </div>

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
        
            </div>
            <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
