@extends('kerangka.master')
@section('title', 'Dashboard')
@section('content')
    <style>
        .apexcharts-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .apexcharts-legend-series {
            width: calc(50% - 10px);
            display: flex;
            justify-content: center;
            margin: 5px;
        }

        .apexcharts-legend-series .apexcharts-legend-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }

        .apexcharts-legend-series .apexcharts-legend-marker {
            width: 10px;
            height: 10px;
            margin-right: 5px;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid container-respons">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="row my-3 respon-ta">
                            <div class="row">
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldShow"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Barang Masuk</h6>
                                                    <h6 class="font-extrabold mb-0" id="jumlah_barang_masuk">
                                                        {{ $totalBarangMasuk }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Barang Keluar</h6>
                                                    <h6 class="font-extrabold mb-0" id="jumlah_barang_keluar">
                                                        {{ $totalBarangKeluar }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldAdd-User"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Peminjaman</h6>
                                                    <h6 class="font-extrabold mb-0" id="jumlah_peminjaman">
                                                        {{ $totalPeminjaman }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Pengembalian</h6>
                                                    <h6 class="font-extrabold mb-0">
                                                        {{ $totalPengembalian }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex align-items-stretch mt-3">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                            <div class="mb-3 mb-sm-0"></div>
                                            <div></div>
                                        </div>
                                        <h4>Chart</h4>
                                        <div id="chart" style="min-height: 350px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex align-items-stretch mt-3">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <table class="table table-hover table-lg" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Description</th>
                                                    <th>Created at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logs as $log)
                                                    <tr>
                                                        <th class="col-3">{{ $log->causer->name ?? 'anonim' }}</th>
                                                        <th class="col-auto">{{ $log->description ?? 'null' }}</th>
                                                        <th class="col-auto">{{ $log->created_at }}</th>
                                                        <th class="col-auto"><a href="#"
                                                                class="badge fw-semibold py-1 w-85 bg-primary-subtle text-primary">Detail</a>
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Chart
            const barangMasuk = @json($barangMasuk);
            const barangKeluar = @json($barangKeluar);
            const peminjamanBarang = @json($peminjamanBarang);
            const pengembalianBarang = @json($pengembalianBarang);
            const bulan = @json($bulan);

            // Konfigurasi Chart
            const chartOptions = {
                series: [{
                    name: 'Barang Masuk',
                    data: bulan.map(month => barangMasuk[month] || 0)
                }, {
                    name: 'Barang Keluar',
                    data: bulan.map(month => barangKeluar[month] || 0)
                }, {
                    name: 'Peminjaman Barang',
                    data: bulan.map(month => peminjamanBarang[month] || 0)
                }, {
                    name: 'Pengembalian Barang',
                    data: bulan.map(month => pengembalianBarang[month] || 0)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    offsetX: -15,
                    toolbar: {
                        show: true
                    },
                    foreColor: "#adb0bb",
                    fontFamily: 'inherit',
                },
                colors: ['#00E396', '#FF4560', '#FEB019', '#008FFB'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "35%",
                        borderRadius: [6],
                        borderRadiusApplication: 'end',
                        borderRadiusWhenStacked: 'all'
                    },
                },
                markers: {
                    size: 0
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    floating: false,
                    offsetY: 10,
                    offsetX: 0,
                    itemMargin: {
                        horizontal: 2,
                        vertical: 15
                    },
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 5
                    },
                    formatter: function(seriesName, opts) {
                        return seriesName;
                    }
                },
                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },
                xaxis: {
                    type: "category",
                    categories: bulan,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color"
                        },
                    },
                },
                yaxis: {
                    show: true,
                    min: 0,
                    max: Math.max(
                        ...bulan.map(month => barangMasuk[month] || 0),
                        ...bulan.map(month => barangKeluar[month] || 0),
                        ...bulan.map(month => peminjamanBarang[month] || 0),
                        ...bulan.map(month => pengembalianBarang[month] || 0)
                    ) + 5,
                    tickAmount: 4,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color",
                        },
                    },
                },
                stroke: {
                    show: true,
                    width: 3,
                    lineCap: "butt",
                    colors: ["transparent"],
                },
                tooltip: {
                    theme: "light"
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 3,
                            }
                        },
                    }
                }]
            };

            // Inisialisasi Chart
            const chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
            chart.render();
        });
    </script>
@endsection
