@extends('layouts.master')

@section('title')

@endsection

@section('content')

    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->

    <!-- Main Sidebar -->
    @include('components.main_sidebar')
    <!-- End Main Sidebar -->

    <!-- Main Sidebar -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create User</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Fill In All The Following Input</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.users.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}" required>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name"
                                               value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email"
                                               name="email"
                                               value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                    </div>
                                    <input type="password" class="form-control" id="password"
                                           name="password"
                                           value="{{ old('password') }}" required>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation"
                                               value="{{ old('password_confirmation') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="custom-select" name="role" required>
                                            <option value="admin" {{old('role') == 'admin' ?? "selected"}}>Admin
                                            </option>
                                            <option value="agent" {{old('roel') == 'agent' ?? "selected"}}>Agent
                                            </option>
                                            <option value="user" {{old('role') == 'user' ?? "selected"}}>User</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->

                    <!-- right column -->
                    <div class="col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- End Main Sidebar -->
@endsection
