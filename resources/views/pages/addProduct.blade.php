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
              <li class="breadcrumb-item"><a href="product.php">Products</a></li>
              <li class="breadcrumb-item active">Add Products</li>
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
                <div class="col-12 justify-content-center">

                </div>
              <div class="card-header d-flex justify-content-end bg-primary">
                <h3 class="card-title col align-self-center">Add Products</h3>
              </div>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger bg-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <input type="text" class="form-control" id="productCode" name="product_code" placeholder="Product Code">
                    </div>
                    <div class="form-group">
                    <label for="produc_name">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="product_name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                    <label for="category">Category</label>
                        <select id="category" name="category" class="form-control">
                        <option>Choose Category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group mb-3">
                            <input type="number" name="price" id="price" class="form-control">
                            <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="images[]" multiple>
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                      </div>
                    </div>
                 </div>
              </div>
            </div>
          </div>
             </div>
                 <!-- /.card-body -->
                <div class="card-footer bg-transparent border">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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