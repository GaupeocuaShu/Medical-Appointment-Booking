@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalAdmin }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>News</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalNews }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Doctors</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalDoctor }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUser }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Top 10 Favorite Doctor</h4>
                        <div class="card-header-action">
                            <form class="form-group d-flex ">
                                <select class="form-control" name="month">
                                    <option value="1">Jannuary</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">Jun</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">Setempber</option>
                                    <option value="10">Octorber</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <button class="btn btn-primary ml-4 top-ten-filter">Filter</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body ">

                        <div class="d-none bar-chart-loading"
                            style="display: flex;justify-content:center;align-items:center"> <i class="fa fa-cog fa-spin"
                                style="font-size:4rem"></i>
                        </div>

                        <div class="bar-chart">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistics</h4>
                        <div class="card-header-action">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="lineChart"></canvas>
                        </div>

                        <div class="statistic-details mt-sm-4">
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                    7%</span>
                                <div class="detail-value">$243</div>
                                <div class="detail-name">Today's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                    23%</span>
                                <div class="detail-value">$2,902</div>
                                <div class="detail-name">This Week's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span>9%</span>
                                <div class="detail-value">$12,821</div>
                                <div class="detail-name">This Month's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                    19%</span>
                                <div class="detail-value">$92,142</div>
                                <div class="detail-name">This Year's Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            function init() {
                getTopTenFavDoctor(1)
            }

            init()
            // Thống kê 10 bác sĩ được yêu thích nhất (Số lượng lịch đặt nhiều nhất)  
            const barChart = document.getElementById('barChart');
            let barChartConfig;

            function setBarChartConfig(labels, datas) {
                barChartConfig = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Completed Schedule',
                            data: datas,
                            borderWidth: 1,
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132)',
                                'rgba(255, 159, 64)',
                                'rgba(255, 205, 86)',
                                'rgba(75, 192, 192)',
                                'rgba(54, 162, 235)',
                                'rgba(153, 102, 255)',
                                'rgba(201, 203, 207)'
                            ],
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value, index, values) {
                                        return Number.isInteger(value) ? value : '';
                                    }
                                }
                            }]
                        }


                    }
                }
            }

            function renderBarChart() {
                new Chart(barChart, barChartConfig);
            }

            function getTopTenFavDoctor(month) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.dashboard.top-ten-fav-doctor') }}",
                    data: month,
                    dataType: "JSON",
                    beforeSend: function() {
                        $(".bar-chart-loading").removeClass('d-none');
                        $(".bar-chart").addClass('d-none');
                    },
                    success: function(response) {
                        setBarChartConfig(response.labels, response.datas)
                        renderBarChart();
                        $(".bar-chart-loading").addClass('d-none');
                        $(".bar-chart").removeClass('d-none');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.table(jqXHR)
                    }
                });
            }
            $(".top-ten-filter").on('click', function(e) {
                e.preventDefault();
                const month = $(this).closest('form').serialize();
                getTopTenFavDoctor(month);
            });





            // const lineChart = document.getElementById('lineChart');
            // const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
            // const data = {
            //     labels: labels,
            //     datasets: [{
            //         label: 'My First Dataset',
            //         data: [65, 59, 80, 81, 56, 55, 40],
            //         fill: false,
            //         borderColor: 'rgb(75, 192, 192)',
            //         tension: 0.1
            //     }]
            // };
            // const lineChartConfig = {
            //     type: 'line',
            //     data: data,
            // };
            // new Chart(lineChart, lineChartConfig)
        });
    </script>
@endpush
