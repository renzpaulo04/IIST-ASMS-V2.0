<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition register-page">

<section class="content">
      <div class="container-fluid">


    <div class="card card-outline card-success">
    <div class="card-header text-center">
    <a href="" class="h1"><b><a class="h1" href="{{ url('/home') }}">IIST-ASMS</a></b></a>
    </div>
        <div class="card-body ">
            <p class="login-box-msg">Register Account</p>

            <form method="post" action="{{ route('register') }}">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> {{ Session::get('success')}}</strong>
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> {{ Session::get('error')}}</strong>

                    </div>
                @endif
                @csrf
                <div class="row">

                <label class="input-group col-xs-2 col-md-4 mb-0">Last Name:</label>


                <label class="input-group col-xs-2 col-md-4 mb-0">First Name:</label>


                <label class="input-group col-xs-2 col-md-4 mb-0">Middle Name:</label>

                </div>
                <div class="row">
                <div class="input-group col-xs-3 col-md-4 mb-3">
                    <input type="text"
                           name="lastName"
                           class="form-control @error('lastName') is-invalid @enderror"
                           value="{{ old('lastName') }}"
                           placeholder="last Name">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('lastName')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

                </div>



                <div class="input-group col-xs-3 col-md-4 mb-3">

                    <input type="text"
                           name="firstName"
                           class="form-control @error('firstName') is-invalid @enderror"
                           value="{{ old('firstName') }}"
                           placeholder="First Name">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('firstName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-xs-3 col-md-4 mb-3">
                    <input type="text"
                           name="middleName"
                           class="form-control @error('middleName') is-invalid @enderror"
                           value="{{ old('middleName') }}"
                           placeholder="Middle Name">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('middleName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </div>

                <div class="row">
                <label class="input-group col-xs-2 col-md-4 mb-0">Id number:</label>
                <label class="input-group col-xs-2 col-md-4 mb-0">Email:</label>
                <label class="input-group col-xs-2 col-md-4 mb-0">Contact Number:</label>
                </div>

                <div class="row">
                <div class="input-group  col-xs-3 col-md-4 mb-2">
                    <input type="text"
                           name="idNumber"
                           class="form-control @error('idNumber') is-invalid @enderror"
                           value="{{ old('idNumber') }}"
                           placeholder="Id Number">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('idNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group  col-xs-3 col-md-4 mb-2">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group  col-xs-3 col-md-4 mb-2">
                    <input type="number"
                           name="contactNumber"
                           value="{{ old('contactNumber') }}"
                           class="form-control @error('contactNumber') is-invalid @enderror"
                           placeholder="Contact Number" min="09000000000" max="09999999999">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('contactNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </div>
                <label class="input-group col-xs-2 col-md-4 mb-0">Password:</label>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password">
                    <div class="input-group-append">
                        <div type="button" id="show_password" class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label class="input-group col-xs-2 col-md-4 mb-0">Retype Password:</label>
                <div class="input-group mb-3">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <label class="input-group col-xs-2 col-md-4 mb-0">Select Role:</label>
                <div class="input-group mb-3">
                <select id="role"  wire:model="roleId" wire:model.defer="state.role" name="role" class="form-control @error('role') is-invalid @enderror">
                                <option disable Select>--Select Role--</option>

                                <option value="STUDENT">IIST STUDENT</option>
                                <option value="IISTFACULTY">IIST FACULTY</option>
                                <option value="OTHERFACULTY">OTHER FACULTY</option>

                            </select>
                 </div>




                <div class="row">
                    <div class="col-8">
                    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <!-- /.form-box -->
    </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>

