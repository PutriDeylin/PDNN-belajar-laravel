@extends('layouts.main')
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $jumlahProduk }}</h3>
                <p>Jumlah Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $jumlahKategori }}</h3>
                <p>Jumlah Kategori Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Rp. {{ number_format($jumlahTotalHarga, 0, ',', '.') }}</h3>
                <p>Jumlah Total Harga Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $jumlahStok }}</h3>
                <p>Jumlah Stok Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"
                         style="position: relative; height: 300px;">
                        <div id="chartProduk" style="height: 300px;"></div>
                     </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
              </section>

              <!-- Custom tabs (Charts with tabs)-->
              <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"
                         style="position: relative; height: 300px;">
                        <div id="chartHarga" style="height: 300px;"></div>
                     </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>

            <!-- /.Left col -->
            <section class="col-lg-6 connectedSortable">
              <!-- Map card -->
              <div class="card bg-gradient-light">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Chart Pie Stock
                  </h3>
                </div>
                <div class="card-body">
                  <div id="chartPie" style="height: 250px; width: 100%;"></div>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        // Chart Jumlah Produk Per Kategori
        var chartData = {!! $chartData !!};

        Highcharts.chart('chartProduk', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Jumlah Produk Per Kategori',
        },
        xAxis: {
            categories: chartData.map(item => item.name),
            crosshair: true,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Produk'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Kategori',
                data: chartData.map(item => item.y),
                color: '#5819d2'
            }
        ]
        });

        // Chart Jumlah Total Harga Produk Per Kategori
        var chartHarga = {!! $chartHarga !!};

        Highcharts.chart('chartHarga', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Total Harga Produk Per Kategori',
            },
            xAxis: {
                categories: chartHarga.map(item => item.name),
                crosshair: true,
            },
            yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Total Harga Produk'
            }
            },
            tooltip: {
            valueSuffix: ''
            },
            plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
            },
            series: [
            {
                name: 'Kategori',
                data: chartHarga.map(item => item.y),
                color: '#2dee4c'
            }
            ]
        });

        // Chart Jumlah Stok Produk Per Kategori
        var chartStock = {!! $chartStock !!};
        Highcharts.chart('chartPie', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Jumlah Stok Produk Per Kategori'
        },
        tooltip: {
            valueSuffix: ' Produk'
        },
        series: [
            {
                name: 'Stock',
                colorByPoint: true,
                data: chartStock.map(item => ({ name: item.name, y: item.y }))
            }
        ]
        });
    });
</script>
@endsection
