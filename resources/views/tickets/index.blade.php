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
                        <h1>Tickets</h1>
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
                                <h3 class="card-title">List Of Your Tickets</h3>
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.tickets.create') : (auth()->user()->role === 'agent' ? route('agent.tickets.create') : route('user.tickets.create')) }}"
                                   class="btn btn-primary float-right">
                                    Create New Ticket
                                </a>
                            </div>
                            <!-- /.card-header -->
                            @php
                                $prefix = request()->segment(1);
                            @endphp
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        {{--                                        @if($prefix == 'admin')--}}
                                        <th>Actions</th>
                                        {{--                                        @endif--}}
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($tickets as $key => $ticket)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ticket->title }}</td>
                                            <td>{{ $ticket->creator->name }}</td>
                                            <td>{{ $ticket->assignee?->name ?? 'No One' }}</td>
                                            <td>{{ $ticket->status }}</td>
                                            <td>{{ $ticket->priority }}</td>

                                            <td>
                                                <div style="display: flex; align-items: center; gap: 5px;">
                                                    <a href="{{ route($prefix . '.tickets.show', $ticket->id) }}"
                                                       title="Show">
                                                        <i class="fa fa-eye" style="color:#212529"></i>
                                                    </a>
                                                    &nbsp
                                                    @if($prefix == 'admin')
                                                        <a href="{{ route($prefix . '.tickets.edit', $ticket->id) }}"
                                                           title="Edit">
                                                            <i class="fa fa-edit" style="color:#212529"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route($prefix . '.tickets.destroy', $ticket->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-clean btn-icon m-1 confirmDelete"
                                                                    title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No tickets found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        {{ $tickets->links('vendor.pagination.custom') }}
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
