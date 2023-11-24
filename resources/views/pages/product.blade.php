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
              <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
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
                      <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="nav-icon fas fa-plus mr-2"></i> Add Product</a>
                    </div>
                  </div>
                  <!-- / add data -->
                  <!-- search data -->
                  <form action="{{ route('products') }}" method="get">
                    <div class="input-group col-sm-11 mr-3">
                      <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                      <div class="input-group-append">
                          <button class="btn btn-default" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                      </div>
                    </div>
                  </form>
                  <!-- search data
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
              search data -->
                </div>
              <div class="card-body">
              @if (session('success'))
                    <div class="alert alert-success bg-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Id</th>
                      <th class="text-center">Product Name</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $key => $product)
                    {{-- @dd($product) --}}
                    <tr>
                        <td>{{ $startNumber++ }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                        @php
                            $images = json_decode($product->image);
                        @endphp
                        @if (is_array($images))
                        <div class="text-center">
                            @foreach ($images as $image)
                            <img src="{{ asset('storage/image/' . $image) }}" alt="image" width="100">
                            @endforeach
                        </div>
                        @endif
                        </td>
                        <td class="text-center">
                      <div class="btn-group" role="group" aria-label="Product">
                          <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                              <i class="nav-icon fas fa-edit mr-2"></i>Edit
                          </a>

                          <form action="{{ route('products.delete', $product->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger ml-2" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">
                                  <i class="nav-icon fas fa-trash-alt mr-2"></i>Delete
                              </button>
                          </form>
                      </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent border">
                <div class="float-right">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
              </div>
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
