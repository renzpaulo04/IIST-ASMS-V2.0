<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Schedule
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('faculty.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
        </div>
        <div class="card card-outline card-success">
            <div class="card-body">
                <div class="control-group">
                    <div class="row mt-2">
                      <div class="col-xs-3 col-md-2 mb-1">
                                <label>Start School Year {{$dt}}</label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                            <label wire:model="semesterId" value="{{$semesters}}">{{$semesters}} Semester</label>
                                 </div>

                         </div>
                    </div>
                </div>
            </div>
    <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive-md">
                    <table id="example2" class="table table-bordered table-striped">
                    @if(!empty($generates))
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
                                    {{$lesson->subject}}
                                      <br>

                                        {{$lesson->course}}  {{$lesson->year[0]}}-{{$lesson->section}}</td>
                                    @elseif ($generates->where('weekday',$day)->where('startTime','<',$time['end'])->where('endTime','>',$time['start'])->count())

                                    @else
                                    <td></td>
                                    @endif

                                @endforeach

                                </tr>
                                @endforeach
                                @else
                                <label class="form-control">Input start school year and semester to see your schedule if available</label>
                            </tbody>

                                @endif
                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
