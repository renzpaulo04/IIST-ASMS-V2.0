<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Set Up
                <small>Schedule</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Set up Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Create Schedule Data
    </button>
    <div class="btn-group ml-2">

        <button id="all" wire:click="filterGeneratesByCourse" type="button" class="btn {{is_null($courseview) ? 'btn-secondary':'btn-default'}} btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info">{{$courseCount}}</span>
        </button>
        <button  wire:click="dataReset" type="button" class="btn btn-info btn-sm">
            <span class="mr-1">Archive</span>
        </button>
 </div>
    </div>
</div>
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
                                <th> Program Code</th>
                                <th> Year</th>
                                <th> Section</th>
                                <th> Semester </th>
                                <th> Course title </th>
                                <th> Teacher </th>
                                <th> Room </th>
                                <th> Weekdays </th>
                                <th> Start time </th>
                                <th> End time </th>
                                <th>Start School year </th>
                                <th>End school year</th>
                                <th> Created By</th>
                                <th> Updated By</th>


                            </tr>
                        </thead>


                        <tbody>

                        @if($generateviews->isnotEmpty())
                        @foreach($generateviews as $generateview)
                            <tr>

                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="{{$generateview->id}}" name="todo2" id="{{$generateview->id}}">
                                        <label for="{{$generateview->id}}"></label>
                                    </div>
                                </th>
                                <td>{{$generateview->course}}</td>
                                <td>{{$generateview->year}}</td>
                                <td>{{$generateview->section}}</td>
                                <td>{{$generateview->semester}}</td>
                                <td>{{$generateview->subject}}</td>
                                <td>{{$generateview->teacher}}</td>
                                <td>{{$generateview->room}}</td>
                                <td>{{$generateview->weekday}}</td>
                                <td>{{$generateview->startTime}}</td>
                                <td>{{$generateview->endTime}}</td>
                                <td>{{$generateview->startSchool}}</td>
                                <td>{{$generateview->endSchool}}</td>
                                @if($user = $users->where('idNumber',$generateview->created_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                                @if($user = $users->where('idNumber',$generateview->changed_by)->first())
                                <td>{{ucfirst(trans($user->lastName))}}, {{ucfirst(trans($user->firstName))}} {{ucfirst(trans($user->middleName[0]))}}.</td>
                                @else
                                <td></td>
                                @endif
                            </tr>

                            @endforeach
                            @else
                            <tr>
                           <td colspan="15" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr>
                                @endif
                        </tbody>


                    </table>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                {{$generateviews->links()}}
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
            <form autocomplete="off" wire:submit.prevent="createGenerate">
            <div class="modal-content">

                <div class="modal-header bg-gradient-{{($ActiveR == 'hide') ? 'success':'primary'}}">
                    <h5 class="modal-title" id="exampleModalLabel">

                        <span>Add New Schedule</span>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

</div>
                <div class="modal-body">
                <div class="control-group">
                 <div class="row ">
                 <div class="col-xs-3 col-md-1 mb-1">
                                <label>Name:</label>
                            </div>
                            <div class="col-xs-3 col-md-3 mb-2">
                                <select wire:model="teacherId" name="teacherId"class="form-control">
                                <option value="">--Select Teacher Name--</option>
                                @foreach ($facultys as $faculty)
                                <option value="{{$faculty->idNumber}}">{{ucfirst(trans($faculty->lastName))}}, {{ucfirst(trans($faculty->firstName))}} {{ucfirst(trans($faculty->middleName[0]))}}.</option>
                                @endforeach
                                </select>
                                 </div>
                    <div class="col-xs-3 col-md-2 mb-1">
                    @foreach($teachers as $teacher)
                                <label >ID Code: {{$teacher->idNumber}}</label>
                                @endforeach
                            </div>

                        <div class="col-xs-3 col-md-2 mb-1">
                                <label wire:model="semesterId" value="{{$semesters}}">{{$semesters}} Semester</label>
                            </div>
                                 <div class="col-xs-3 col-md-3 mb-1">
                                <label wire:model="startSchoolYearId" value="{{$dt}}">Start School Year: {{$dt}}</label>
                            </div>

                    </div>
                    </div>
                </div>
                <div class="card card-outline card-{{($ActiveR == 'hide') ? 'primary':'success'}}">
              <div class="card-header p-2">
              <div class="btn-group ml-2">
        <button id="active" wire:click="regularClass" type="button" class="btn {{is_null($ActiveR) ? 'btn-primary':'btn-default'}} btn-sm" data-toggle="tab">
            <span class="mr-1">Regular Class</span>
        </button>
        <button id="hide" wire:click="regularClass('hide')"type="button" class="btn {{($ActiveR == 'hide') ? 'btn-success':'btn-default'}} btn-sm" data-toggle="tab">
            <span class="mr-1">Special Class</span>
        </button>
    </div>

              </div><!-- /.card- -->

              </div><!-- /.card-header -->
              <div class="card-body">

              <div class="tab-content">
                <div class="tab-pane  {{is_null($ActiveR) ? 'active': $ActiveS }}"  >
                  <form class="form-horizontal">
                      <div class="form-group row">
                      <div class="col-xs-2 col-md-1 mb-2" >
                                <label class="text-primary">Program Code</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary" >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label class="text-primary">Course Title</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label class="text-primary">Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label class="text-primary">Time End</label>
                            </div>
                      </div>
                      <div class="form-group row">

                      <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="Program Code">
                        <option value="">-Courses-</option>
                        @foreach ($courses as $course)
                                <option value='{{$course->course_code}}'>{{$course->course_code}}</option>
                        @endforeach
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select  wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
                                <option  value="">-Year-</option>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            @foreach ($sections as $section)
                                    <option value='{{$section}}'>{{$section}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select Course--</option>
                            @foreach ($subjects as $subject)
                                    <option value='{{$subject->subject_code}}'>{{$subject->subject_title}}</option>
                            @endforeach
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            @foreach ($rooms as $room)
                                    <option value='{{$room->room}}'>{{$room->room}}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                @foreach ($weekdays as $weekday)
                                        <option value='{{$weekday}}'>{{$weekday}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-primary">Save</button>
                        </div>
                      </div>

                    </form>
                </div>
                  <!-- /.tab-pane -->


                <div class="tab-pane {{$ActiveSp}}" >
                  <form class="form-horizontal" >
                  <div class="form-group row">
                      <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success" >Program Code</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label class="text-success">Course title</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label class="text-success">Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label class="text-success">Time End</label>
                            </div>
                      </div>
                      <div class="form-group row">

                      <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="Program Code">
                        <option value="">-Courses-</option>
                        @foreach ($courses as $course)
                                <option value='{{$course->course_code}}'>{{$course->course_code}}</option>
                        @endforeach
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
                                <option value="">-Year-</option>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            @foreach ($sections as $section)
                                    <option value='{{$section}}'>{{$section}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select course--</option>
                            @foreach ($subjects as $subject)
                                    <option value='{{$subject->subject_code}}'>{{$subject->subject_title}}</option>
                            @endforeach
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            @foreach ($rooms as $room)
                                    <option value='{{$room->room}}'>{{$room->room}}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                @foreach ($weekdays as $weekday)
                                        <option value='{{$weekday}}'>{{$weekday}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    </form>
                </div>
                  <!-- /.tab-pane -->

                  </div>
                <!-- /.tab-content -->
            <!--    <div class="card-body">
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label >Course</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Subject</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label>Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label>Time End</label>
                            </div>

                    </div>
                    </div>

                    <div class="control-group">
                    <div class="row mt-2">

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="courses">
                        <option value="">-Courses-</option>
                        @foreach ($courses as $course)
                                <option value='{{$course->course_code}}'>{{$course->course_code}}</option>
                        @endforeach
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
                                <option value="">-Year-</option>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            @foreach ($sections as $section)
                                    <option value='{{$section}}'>{{$section}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select Subject--</option>
                            @foreach ($subjects as $subject)
                                    <option value='{{$subject->subject_code}}'>{{$subject->subject_title}}</option>
                            @endforeach
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            @foreach ($rooms as $room)
                                    <option value='{{$room->room}}'>{{$room->room}}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                @foreach ($weekdays as $weekday)
                                        <option value='{{$weekday}}'>{{$weekday}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                        </div>
                    </div>
                    </div>
                </div> -->
                </div>
        <div class="card card-outline card-{{($ActiveR == 'hide') ? 'primary':'success'}}">
    <div class="card-body">
    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Regular Units: </label>

                            </div>
                                 <div class="col-xs-2 col-md-1 mb-2">
                                 @foreach($showUnits as $showUnit)
                                <label>{{$showUnit->regular}}</label>
                                @endforeach
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >OverLoad:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                             @foreach($showUnits as $showUnit)
                                <label>{{$showUnit->overload}}</label>
                                @endforeach
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Total Units:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                            @foreach($showUnits as $showUnit)
                                <label>{{$showUnit->overload + $showUnit->regular + $showUnit->units }} </label>
                                @endforeach
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Designation:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                            @foreach($showUnits as $showUnit)
                                <label>{{$showUnit->units }} </label>
                                @endforeach
                            </div>
                    </div>
                    </div>
    </div>
        </div>
<div class="card card-outline card-{{($ActiveR == 'hide') ? 'primary':'success'}}">
    <div class="card-body">
        <div class="control-group">
            <div class="table-responsive-md">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <th with='125'>Time</th>
                        @foreach($weekDays as $day)
                        <th>{{$day}}</th>
                         @endforeach
                        </thead>
                            <tbody>




                             @foreach($timeRange as $time)
                                <tr>

                                     <td style="padding-left: 10px;
                                        padding-bottom: 3px; padding-top: 3px;">{{$time['start']}}-{{$time['end']}}</td>

                                @foreach($weekDays as $index => $day)

                                    @if($lesson = $generates->where('weekday',$day)->where('startTime',$time['start'])->first())

                                        <td rowspan="{{$lesson->difference/30 ?? '' }}" class="align-middle text-center" style="background-color:#f0f0f0">
                                        {{$lesson->room}}<br>
                                        {{$lesson->subject}}<br>
                                        {{$lesson->course}}  {{$lesson->year[0]}}-{{$lesson->section}}</td>
                                    </td>
                                    @elseif ($generates->where('weekday',$day)->where('startTime','<=',$time['end'])->where('endTime','>',$time['start'])->count())

                                    @else
                                    <td></td>
                                    @endif

                                @endforeach
                                </tr>
                                @endforeach


                            </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


                    <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Done</span>

                        </button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!----------End Modal for adding Room and editting Room -------->
</div>
