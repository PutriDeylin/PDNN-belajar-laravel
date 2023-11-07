@extends('layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
            <div class="card">
              <div class="card-header d-flex col-sm-12 justify-content-between">
                <div class="col-10">
                  <!-- add data -->
                  <div class="col-sm-2">
                      <a href="#" class="btn btn-primary"><i class="nav-icon fas fa-plus mr-2"></i> Add Product</a>
                    </div>
                  </div>
                  <!-- / add data -->
                  <!-- search data -->
                  <form action="product.php?aksi=cari" method="post">
                    <div class="input-group col-sm-11 mr-3">
                      <input type="text" name="search" id="search" class="form-control" placeholder="Search">
                      <div class="input-group-append">
                          <button class="btn btn-default" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                      </div>
                    </div>
                  </form>
                  <!-- / search data -->
                </div>
                <!-- <h3 class="card-title col align-self-center">List Products</h3> -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">Id</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th style="width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sepatu Under Armour</td>
                        <td>Sport</td>
                        <td>200.000</td>
                        <td>
                        <div class="text-center">
                            <img src="{{ asset('image/sepatu.jpg') }}" alt="" width="100">
                        </div>
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning"><i class="nav-icon fas fa-edit mr-2"></i>Edit</a>
                            <a href="#" class="btn btn-danger"><i class="nav-icon fas fa-trash-alt mr-2"></i>Delete</a>
                        </td>
                    </tr>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
