
<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
               @if( Auth::user()->role == 'IISTFACULTY')
                            <a href="{{route('faculty.dashboard')}}" class="nav-link {{ (request()->is('faculty/dashboard')) ? 'active': '' }}">
                                <i class="fas fa-desktop nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                @elseif( Auth::user()->role == 'STUDENT')
                            <a href="{{route('student.dashboard')}}" class="nav-link {{ (request()->is('student/student-dashboard')) ? 'active': '' }}">
                                <i class="fas fa-desktop nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                @elseif( Auth::user()->role == 'OTHERFACULTY')
                            <a href="{{route('guest.dashboard')}}" class="nav-link {{ (request()->is('guest/guest-dashboard')) ? 'active': '' }}">
                                <i class="fas fa-desktop nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                @endif
                </li>
                @if( Auth::user()->role == 'IISTFACULTY')
                <li class="nav-item">
                            <a href="{{route('faculty.schedule')}}" class="nav-link {{ (request()->is('faculty/faculty-schedule-view')) ? 'active': '' }}">
                            <i class="fas fa-clipboard-list"></i>
                                <p> View Schedule</p>
                            </a>
                </li>
                <li class="nav-item">
                            <a href="{{route('faculty.profile')}}" class="nav-link {{ (request()->is('faculty/faculty-profile')) ? 'active': '' }}">
                            <i class="fas fa-id-card"></i>
                                <p> Profile</p>
                            </a>
                </li>
                <li class="nav-item">
                            <a href="{{route('faculty.attendance')}}" class="nav-link {{ (request()->is('faculty/faculty-attendance')) ? 'active': '' }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                                <p>Attendance</p>
                            </a>
                </li>
                @elseif( Auth::user()->role == 'STUDENT')
                <li class="nav-item">
                            <a href="{{route('student.schedule')}}" class="nav-link {{ (request()->is('student/student-schedule-v-iew')) ? 'active': '' }}">
                            <i class="fas fa-clipboard-list"></i>
                                <p> View Schedule</p>
                            </a>
                            </li>
                    <li class="nav-item">
                            <a href="{{route('student.profile')}}" class="nav-link {{ (request()->is('student/student-profile')) ? 'active': '' }}">
                            <i class="fas fa-id-card"></i>
                                <p> Profile</p>
                            </a>
                </li>

                @elseif( Auth::user()->role == 'OTHERFACULTY')
                        <li class="nav-item">
                            <a href="{{route('guest.profile')}}" class="nav-link {{ (request()->is('guest/list-generates'))  ? 'active' : '' }}">
                                <i class="fas fa-id-card"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        @endif
