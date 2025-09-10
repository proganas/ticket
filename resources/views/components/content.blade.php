<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success text-center">
                        <div class="inner">
                            <h3>{{ $openCount }}</h3>

                            <p>Open Ticket(s)</p>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger text-center">
                        <div class="inner">
                            <h3>{{ $closedCount }}</h3>

                            <p>Close Ticket(s)</p>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                @if(Auth::user()->role == 'agent')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning text-center">
                            <div class="inner">
                                <h3>{{ $assignedToCount }}</h3>

                                <p>Ticket(s) Assigned To No One</p>
                            </div>

                        </div>
                    </div>
                @endif
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
