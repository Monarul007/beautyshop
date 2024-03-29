@extends('layouts.admin.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/index">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @if ($success = Session::get('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $success }}</strong>
                </div>
                @endif
                @foreach($category as $cat)
                    
                    @php( $name = $cat->name)
                    @php( $description = $cat->description )
                    @php( $parent = $cat->parent_id )
                    @php( $status = $cat->status )
                    @php( $url = $cat->url )
                                        
                @endforeach
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/edit_category/'.$id) }}" id="addCaategory" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="inputName">Category Name</label>
                                <input type="text" name="cat_name" value="{{$name}}" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cat_desc">Category Description</label>
                                <textarea id="cat_desc" name="cat_desc" class="form-control">{{$description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent_cat">Parent Category</label>
                                <select id="parent_cat" name="parent_cat" class="form-control">
                                    <option value="0">Main Category</option>
                                    @for($i = 0; $i < count($catArray);)
                                        <option selected value="{{$catArray[$i+1]}}">{{ $catArray[$i] }}</option>
                                            {{$i = $i + 2}}
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="inputStatus" name="cat_status" class="form-control custom-select">
                                    <option selected value="{{$status}}"><?php 
                                    if($status == 0){
                                        echo 'Inactive';
                                    }elseif($status == 1){
                                        echo 'Active';
                                    }
                                    ?></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cat_url">Category URL</label>
                                <input type="text" id="cat_url" name="cat_url" value="{{$url}}" class="form-control">
                            </div>
                            <div class="card-footer">
                                <a href="/admin/view_categories" class="btn btn-secondary">Cancel</a>
                                <input type="submit" value="Update Category" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });

    $(function () {
        // Summernote
        $('#cat_desc').summernote()
    })
</script>

@endsection