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

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
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
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Name : </h5>
                                <p class="card-text">
                                    {{ $user->name }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Email : </h5>
                                <p class="card-text">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Role : </h5>
                                <p class="card-text">
                                    {{ $user->role }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Created By : </h5>
                                <p class="card-text">
                                    {{ $user->creator->name }}
                                </p>
                            </div>
                        </div>

                        <!-- /.card-body -->

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

