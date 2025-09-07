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
                        <h1>Edit Ticket</h1>
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
                            @php
                                $prefix = request()->segment(1);
                            @endphp
                            <form action="{{ route($prefix . '.tickets.update', $ticket->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}" required>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title"
                                               name="title"
                                               value="{{ old('title', $ticket->title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description"
                                                  name="description">{{ old('description', $ticket->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Assigned To</label>
                                        <select class="custom-select" name="assigned_to" required>
                                            @foreach($users as $user)
                                                <option
                                                    value="{{$user->id}}" {{old('user_id', $ticket->assigned_to) == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="custom-select" name="status" required>
                                            <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="custom-select" name="priority" required>
                                            <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Projects</label>
                                        <select class="custom-select" name="project_id" required>
                                            @foreach($projects as $project)
                                                <option
                                                    value="{{$project->id}}" {{old('project_id', $ticket->project_id) == $project->id ? "selected" : ""}}>{{$project->name}}</option>
                                            @endforeach
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
