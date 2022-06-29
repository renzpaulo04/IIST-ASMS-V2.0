<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Generate
                <small>Schedule</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Generate Schedule</li>
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
       Generate Schedule Data
    </button>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterGeneratesByCourse" type="button" class="btn {{is_null($course) ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info">{{$courseCount}}</span>
        </button>
        <button id="active"wire:click="filterGeneratesByCourse('BSIS')"type="button" class="btn {{($course == 'BSIS') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">BSIS</span>
            <span class="badge badge-pill badge-success">{{$BSISCoursesCount}}</span>
        </button>
        <button id="deactive" wire:click="filterGeneratesByCourse('BSIT')"type="button" class="btn {{($course == 'BSIT') ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">BSIT</span>
            <span class="badge badge-pill badge-primary">{{$BSITCoursesCount}}</span>
        </button>
    </div>
    </div>
    </div>
</div>


<!----------End button fucntion for Room -------->
    <!----------Start Table for generate -------->
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >schedule:  </label>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input  wire:model="search" type="text" name="table_search" class="form-control float-right fas fa-search input-group-sm" placeholder="Search">
                    </div>
                </div>
                </div>
        </div>
              <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive-md">
                    <table id="exampl2" class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> course</th>
                                <th> year</th>
                                <th> section</th>
                                <th> semester </th>
                                <th> subject </th>
                                <th> teacher </th>
                                <th> room </th>
                                <th> weekdays </th>
                                <th> start time </th>
                                <th> end time </th>
                                <th>start School year </th>
                                <th>end school year</th>
                                <th>update </th>


                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($generates))
                        @foreach($generates as $generate)
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$generate->id}}" name="todo2" id="{{$generate->id}}">
                                        <label for="{{$generate->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$generate->course}}</td>
                                <td>{{$generate->year}}</td>
                                <td>{{$generate->section}}</td>
                                <td>{{$generate->semester}}</td>
                                <td>{{$generate->subject}}</td>
                                <td>{{$generate->teacher}}</td>
                                <td>{{$generate->room}}</td>
                                <td>{{$generate->weekday}}</td>
                                <td>{{$generate->startTime}}</td>
                                <td>{{$generate->endTime}}</td>
                                <td>{{$generate->startSchool}}</td>
                                <td>{{$generate->endSchool}}</td>
                                <td><a href="" ><i wire:click.prevent="edit" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                       
                    </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                {{$generates->links()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!----------Start Modal for adding Room and editting Room -------->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditGenerateModal ? 'updateGenerate': 'createGenerate' }}">
            <div class="modal-content">
            @if($showEditGenerateModal)
                <div class="modal-header bg-gradient-info">
                @else
                <div class="modal-header bg-gradient-primary">
                @endif
                    <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditGenerateModal)
                        <span>Edit Schedulet</span>
                    @else
                        <span>Add New Schedule</span>
                    @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        <div class="control-group">
    <div class="row">
      <div class="col-xs-3 col-md-6 mb-6">
        <label >Course : </label>
        <select wire:model="courseId" wire:model.defer="state.course"class="form-control"> 
        @foreach ($courses as $course)
        <option value="">--Select Course--</option> 
                @if($course->course == 'BSIS')
                <option value='BSIS'>BSIS</option>
                @break 
                @endif
        @endforeach
        @foreach ($courses as $course)
                @if($course->course == 'BSIT')
                <option value='BSIT'>BSIT</option>
                @break 
                @endif
        @endforeach
        </select>
        </div>
        @if(!is_null($courseId))
        <div class="col-xs-3 col-md-6 mb-6">
        <label for="yearId">Year : </label>
        <select wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
        <option value="">--Select Course--</option> 
        @foreach ($years as $year)
                @if($year->year == '1st')
                <option value='1st'>1st</option>
                @break 
                @endif
        @endforeach
        @foreach ($years as $year)
        @if($year->year == '2nd')
                <option value='2nd'>2nd</option> 
                @break
         @endif
        @endforeach

        @foreach ($years as $year)
        @if($year->year == '3rd')
                <option value='3rd'>3rd</option> 
                @break
         @endif
        @endforeach
        @foreach ($years as $year)
        @if($year->year == '4th')
                <option value='4th'>4th</option> 
                @break
         @endif
        @endforeach
        </select>
      </div>
      @endif
      @if(!is_null($yearId))
      <div class="col-xs-3 col-md-6 mb-6">
        <label for="sem" >Subject : </label>
        <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
        <option value="" >--Select Section--</option> 
        @foreach ($sections as $section)
        @if($section)
                <option value='A'>A</option> 
                @break
         @endif
        @endforeach
        @foreach ($sections as $section)
        @if($section)
                <option value='B'>B</option> 
                @break
         @endif
        @endforeach
        @foreach ($sections as $section)
        @if($section)
                <option value='C'>C</option> 
                @break
         @endif
        @endforeach
        @foreach ($sections as $section)
        @if($section)
                <option value='D'>D</option> 
                @break
         @endif
        @endforeach
        @foreach ($sections as $section)
        @if($section)
                <option value='E'>E</option> 
                @break
         @endif
        @endforeach
        </select>
      </div> 
      @endif
    @if(!is_null($sectionId))
      <div class="col-xs-3 col-md-6 mb-6">
        <label for="sem" >Semester : </label>
        <select wire:model="semesterId" wire:model.defer="state.semester" id="semesterId" class="form-control" >
        <option value="" >--Select Semester--</option> 
        @foreach ($semesters as $semester)
                @if($semester->semester == '1st')
                <option value='1st'>1st</option>
                @break 
                @endif
        @endforeach
        @foreach ($semesters as $semester)
                @if($semester->semester == '2nd')
                <option value='2nd'>2nd</option>
                @break 
                @endif
        @endforeach
        </select>
      </div> 
      @endif
      @if(!is_null($semesterId))
      <div class="col-xs-3 col-md-6 mb-6">
        <label for="sem" >Subject : </label>
        <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
        <option value="" >--Select Subject--</option> 
        @foreach ($subjects as $subject)
                <option value='{{$subject->courseCode}}'>{{$subject->subjectName}}</option>
        @endforeach
        </select>
      </div> 
      @endif

      @if(!is_null($subjectId))
      <div class="col-xs-3 col-md-6 mb-6">
        <label for="sem" >Teacher : </label>
        <select wire:model="teacherId" wire:model.defer="state.teacher" id="teacherId" class="form-control" >
        <option value="" >--Select teacher--</option> 
        @foreach ($teachers as $teacher)
                <option value='{{$teacher->idNumber}}'>{{$teacher->firstName}} {{$teacher->lastName}}</option>
        @endforeach
        </select>
      </div> 
      @endif

      @if(!is_null($teacherId))
      <div class="col-xs-3 col-md-6 mb-6">
        <label for="sem" >Room : </label>
        <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
        <option value="" >--Select room--</option> 
        @foreach ($rooms as $room)
                <option value='{{$room->room}}'>{{$room->room}}</option>
        @endforeach
        </select>
      </div> 
      @endif
      @if(!is_null($roomId))
      <div class="col-xs-3 col-md-6 mb-6">
       <label for="day" >Weekdays : </label>
       <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
        <option value="">--Select Weekdays--</option> 
        @foreach ($weekdays as $weekday)
                <option value='{{$weekday->day}}'>{{$weekday->day}}</option>
        @endforeach   
        </select>
        </div>
        @endif
        @if(!is_null($weekdayId))
        <div class="col-xs-3 col-md-6 mb-6">
        <label for="time" >Time Start : </label>
        @foreach ($startTimes as $startTime)
        <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime">
        @endforeach 
        </div>
        @endif
        @if(!is_null($startTimeId))
        <div class="col-xs-3 col-md-6 mb-6">
       <label for="endTime" >Time End : </label>
       @foreach ($endTimes as $endTime)
       <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime">
       @endforeach 
       </div>
       @endif
       @if(!is_null($endTimeId))
       <div class="col-xs-3 col-md-6 mb-6">
        <label>Start School Year</label>
        @foreach ($startSchools as $startSchool)
          <input wire:model="startSchoolId" wire:model.defer="state.startSchool" type="number" name="startSchool" class="form-control" min="2000" max="3999" placeholder="2000">
          @endforeach 
        </div>
          @endif
          @if(!is_null($startSchoolId))
       <div class="col-xs-3 col-md-6 mb-6">
        <label>End School Year</label>
          <input wire:model="endSchoolId" wire:model.defer="state.endSchool" name="endSchool" type="number" value="{{$endSchools + 1}}" class="form-control" placeholder="{{$endSchools + 1}}" readonly>
        </div>
          @endif
          </div>
            </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addGenerate" class="btn btn-primary" value="addGenerate"><i class="fa fa-save mr-1"></i>
                        @if($showEditGenerateModal)
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

<!----------End Table for Room -------->
<!----------End Modal for adding Room and editting Room -------->
