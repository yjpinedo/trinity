<div>
    @push('css')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @endpush

    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="page">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="user">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row">
        @foreach ($sectors['sectors'] as $key => $sector)
            @if ($key <= 2)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-{{ $sector['color'] }} elevation-1"><i
                                class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <div class="d-flex justify-content-between alingn-items-center">
                                    <h3>{{ $sector['name'] }}</h3>
                                    <h4>{{ $sector['member_average'] }} <small><i class="fas fa-percentage"></i></small>
                                    </h4>
                                </div>
                            </span>
                            <span class="info-box-number">
                                <h4>{{ $sector['member_count'] }}</h4>
                            </span>
                        </div>
                    </div>
                </div>
                @if ($key == 2)
                    <div class="clearfix hidden-md-up"></div>
                @endif
            @else
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-{{ $sector['color'] }} elevation-1"><i
                                class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <div class="d-flex justify-content-between alingn-items-center">
                                    <h3>{{ $sector['name'] }}</h3>
                                    <h4>{{ $sector['member_average'] }} <small><i
                                                class="fas fa-percentage"></i></small></h4>
                                </div>
                            </span>
                            <span class="info-box-number">
                                <h4>{{ $sector['member_count'] }}</h4>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <div class="d-flex justify-content-between alingn-items-center">
                            <h3>{{ __('Total members') }}</h3>
                            <h4>{{ __('100') }} <small><i class="fas fa-percentage"></i></small></h4>
                        </div>
                    </span>
                    <span class="info-box-number">
                        <h4>{{ $sectors['member_total'] }}</h4>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>{{ __('Baptized') }} <i class="fas fa-percentage"></i></strong></h3>
                </div>
                <div class="card-body">
                    <canvas id="pieChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>{{ __('Baptized for sector') }} <i
                                class="fas fa-percentage"></i></strong></h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @push('js')
        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                let sectorConfig = @this.sectorConfig;
                let memberConfig = @this.memberConfig;
                var areaChartData = {
                    labels: sectorConfig.names,
                    datasets: [{
                            label: sectorConfig.baptized.label[1],
                            backgroundColor: 'rgba(0,31,63, 1)',
                            borderColor: 'rgba(0,31,63, 1)',
                            pointRadius: false,
                            pointColor: 'rgba(10,39,61, 1)',
                            pointStrokeColor: 'rgba(10,39,61,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(10,39,61,1)',
                            data: sectorConfig.baptized.data.no
                        },
                        {
                            label: sectorConfig.baptized.label[0],
                            backgroundColor: '#17a2b8',
                            borderColor: '#17a2b8',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: '#17a2b8',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: '#17a2b8',
                            data: sectorConfig.baptized.data.si
                        }
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }]
                    }
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData);
                barChartData.datasets[0] = areaChartData.datasets[0]
                barChartData.datasets[1] = areaChartData.datasets[1]

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                let baptized = @this.memberConfig.baptized;
                var pieData = {
                    labels: baptized.names,
                    datasets: [{
                        data: baptized.data,
                        backgroundColor: baptized.backgroundColor,
                    }]
                };
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                })
            });
        </script>
    @endpush
</div>
