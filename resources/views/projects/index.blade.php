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
                        <h1>Projects</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List Of All Projects</h3>
                                <a href="{{ route('admin.projects.create') }}"
                                   class="btn btn-primary float-right">
                                    Create New Project
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($projects as $key => $project)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->creator->name }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 5px;">
                                                    <a href="{{ route('admin.projects.show', $project->id) }}"
                                                       title="Show">
                                                        <i class="fa fa-eye" style="color:#212529"></i>
                                                    </a>
                                                    &nbsp
                                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                       title="Edit">
                                                        <i class="fa fa-edit" style="color:#212529"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.projects.destroy', $project->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-clean btn-icon m-1 confirmDelete"
                                                                title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No projects found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        {{ $projects->links('vendor.pagination.custom') }}
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- End Main Sidebar -->
@endsection

@push('scripts')
    <script>
        $('.confirmDelete').click(function (e) {
            return confirm("Are you sure you want to delete this?");
        });
    </script>
@endpush
