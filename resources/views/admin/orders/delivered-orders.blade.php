@extends('layouts.admin.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Delivered Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
              <li class="breadcrumb-item active">View Delivered</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if ($success = Session::get('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $success }}</strong>
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Delivered Orders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="Pendings" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Amount</th>
                    <th>Shipping Method</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($getDelivered as $delivered)
                    <tr>
                        <td>{{$delivered->id}}</td>
                        <td><a href="/admin/get_invoice/{{$delivered->order_number}}">{{$delivered->order_number}}</a></td>
                        <td>{{$delivered->name}}</td>
                        <td>{{$delivered->email}}</td>
                        <td>{{$delivered->grand_total}}</td>
                        <td>{{$delivered->shipping_method}}</td>
                        <td><a href="/admin/get_invoice/{{$delivered->order_number}}"><i class="fa fa-eye"></i> View</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function () {
      $("#Pendings").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
</script>

@endsection