<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Course Schedule
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Course Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
        <div class="card card-outline card-success">
    <div class="card-body">
    <div class="control-group">

                      <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Course </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Semester:</label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-1">
                                <label>Start School Year:</label>
                            </div>

                        </div>
                      <div class="row mt-2">
                            <div class="col-xs-3 col-md-2 mb-2">
                                <select wire:model="courseId" name="courseId"  id="courseId" class="form-control">
                                <option value="">--Select course--</option>
                                @foreach ($courses as $course)
                                <option value="{{$course->course_code}}">{{$course->course_code}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                            <select wire:model="yearId" id="yearId" class="form-control" required>
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
                            <div class="col-xs-3 col-md-2 mb-2">
                            <select wire:model="sectionId" id="sectionId" class="form-control" required>
                                <option value="">-Select Section-</option>

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
                            <div class="col-xs-3 col-md-2 mb-2">
                                <label class="form-control">{{$semesters}}</label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                                <label class="form-control">{{$dt}}</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click="searchId" class="btn btn-primary"><i class="fas fa-search mr-1"></i></button>
                        </div>
                         </div>
            </div>
    </div>
</div>
@if(!empty($generates))
<div class="card card-outline card-success">
    <div class="card-body">

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
                                        @if($teacher = $teachers->where('idNumber',$lesson->teacher)->first())
                                        {{ucfirst(trans($teacher->firstName[0]))}}.{{ucfirst(trans($teacher->middleName[0]))}}.{{ucfirst(trans($teacher->lastName))}}
                                        @endif </td>
                                    @elseif ($generates->where('weekday',$day)->where('startTime','<',$time['end'])->where('endTime','>',$time['start'])->count())

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
@endif
</div>

<!-- /.container-fluid -->
</div>
