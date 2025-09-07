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
                                <h5 class="card-title">Title : </h5>
                                <p class="card-text">
                                    {{ $ticket->title }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Description : </h5>
                                <p class="card-text">
                                    {{ $ticket->description }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status : </h5>
                                <p class="card-text">
                                    {{ $ticket->status }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Priority : </h5>
                                <p class="card-text">
                                    {{ $ticket->priority }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Created By : </h5>
                                <p class="card-text">
                                    {{ $ticket->creator->name }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Assigned To : </h5>
                                <p class="card-text">
                                    {{ $ticket->assignee?->name ?? 'No One' }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Project : </h5>
                                <p class="card-text">
                                    {{ $ticket->project->name }}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Replay : </h5>
                                <p class="card-text">
                                    @if($ticket->message)
                                        {{ $ticket->message }}
                                    @else
                                        No Replay Yet
                                    @endif
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

