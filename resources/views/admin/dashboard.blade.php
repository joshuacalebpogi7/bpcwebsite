<x-admin-layout>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{ ucwords(auth()->user()->username) }}</h3>
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="/images/alumni.jpg" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-bolder"><i class="icon-sun mr-2"></i>{{ date('d') }}
                                </h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-bolder">{{ date('F') }}</h4>
                                <h6 class="font-weight-bold">{{ date('l') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Alumni</p>
                            <p class="fs-30 mb-2">{{ $data['alumniCount'] }}</p>
                            <p>{{ number_format($data['verifiedPercentage'], 2) }}% (Verified alumni)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Courses</p>
                            <p class="fs-30 mb-2">{{ $data['courses']->count() }}</p>
                            <p>{{ $data['courses']->count() }} (Total Number of Courses)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Events</p>
                            <p class="fs-30 mb-2">{{ $data['events']->count() }}</p>
                            <p>{{ $data['activeEvents'] }} (Active events)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Jobs</p>
                            <p class="fs-30 mb-2">{{ $data['jobs']->count() }}</p>
                            <p>{{ $data['jobs']->where('status, active')->count() }} (Active Job Openings)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-title">Alumni by Gender</p>
                        {{-- <a href="#" class="text-info">View all</a> --}}
                    </div>
                    <p class="font-weight-500">The total number of sessions within the date range. It
                        is the period time a user is actively engaged with your website, page or app,
                        etc</p>
                    <div id="alumnigender-legend" class="chartjs-legend mt-4 mb-2"></div>
                    <canvas id="alumnigender-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-title">Alumni by Course</p>
                        {{-- <a href="#" class="text-info">View all</a> --}}
                    </div>
                    <p class="font-weight-500">The total number of sessions within the date range. It
                        is the period time a user is actively engaged with your website, page or app,
                        etc</p>
                    <div id="alumni-legend" class="chartjs-legend mt-4 mb-2"></div>
                    <canvas id="alumni-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                        data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                        <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Employment Status by Course</p>
                                            <h1 class="text-primary">
                                                {{ $data['verifiedAlumni']->where('employment_status', 'employed')->count() }}
                                            </h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">Employed Alumni</h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within
                                                the date range. It is the period time a user is actively
                                                engaged with your website, page or app, etc</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                    <table class="table table-borderless report-table">
                                                        @foreach ($data['courses'] as $course)
                                                            <tr>
                                                                <td class="text-muted">{{ $course->course }}</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4 mb-1">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar"
                                                                            style="width: 
                        @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'employed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'employed')->count() /$data['verifiedAlumni']->where('course', $course->course)->count()) *100 }}% @else
                            0% @endif 
                    "
                                                                            aria-valuenow="70" aria-valuemin="0"
                                                                            aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">
                                                                        {{ $data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'employed')->count() }}
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="north-america-chart"></canvas>
                                                <div id="north-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                        <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Employment Status by Course</p>
                                            <h1 class="text-primary">
                                                {{ $data['verifiedAlumni']->where('employment_status', 'unemployed')->count() }}
                                            </h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">Unemployed Alumni</h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within
                                                the date range. It is the period time a user is actively
                                                engaged with your website, page or app, etc</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                    <table class="table table-borderless report-table">
                                                        @foreach ($data['courses'] as $course)
                                                            <tr>
                                                                <td class="text-muted">{{ $course->course }}</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4 mb-1">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar"
                                                                            style="width: @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'unemployed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'unemployed')->count() /$data['verifiedAlumni']->where('course', $course->course)->count()) *100 }}%  @else 0% @endif"
                                                                            aria-valuenow="70" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">
                                                                        {{ $data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'unemployed')->count() }}
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="south-america-chart"></canvas>
                                                <div id="south-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                        <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Employment Status by Course</p>
                                            <h1 class="text-primary">
                                                {{ $data['verifiedAlumni']->where('employment_status', 'self-employed')->count() }}
                                            </h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">Self-employed Alumni</h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within
                                                the date range. It is the period time a user is actively
                                                engaged with your website, page or app, etc</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                    <table class="table table-borderless report-table">
                                                        @foreach ($data['courses'] as $course)
                                                            <tr>
                                                                <td class="text-muted">{{ $course->course }}</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4 mb-1">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar"
                                                                            style="width: @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'self-employed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'self-employed')->count() /$data['verifiedAlumni']->where('course', $course->course)->count()) *100 }} @else 0% @endif"
                                                                            aria-valuenow="70" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">
                                                                        {{ $data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'self-employed')->count() }}
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="south-america-chart"></canvas>
                                                <div id="south-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Search Engine Marketing</td>
                                    <td class="font-weight-bold">$362</td>
                                    <td>21 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Search Engine Optimization</td>
                                    <td class="font-weight-bold">$116</td>
                                    <td>13 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Display Advertising</td>
                                    <td class="font-weight-bold">$551</td>
                                    <td>28 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pay Per Click Advertising</td>
                                    <td class="font-weight-bold">$523</td>
                                    <td>30 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Mail Marketing</td>
                                    <td class="font-weight-bold">$781</td>
                                    <td>01 Nov 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-danger">Cancelled</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Referral Marketing</td>
                                    <td class="font-weight-bold">$283</td>
                                    <td>20 Mar 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social media marketing</td>
                                    <td class="font-weight-bold">$897</td>
                                    <td>26 Oct 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Projects</p>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="pl-0  pb-2 border-bottom">Places</th>
                                    <th class="border-bottom pb-2">Orders</th>
                                    <th class="border-bottom pb-2">Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-0">Kentucky</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">65</span>(2.15%)</p>
                                    </td>
                                    <td class="text-muted">65</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Ohio</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">54</span>(3.25%)</p>
                                    </td>
                                    <td class="text-muted">51</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Nevada</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">22</span>(2.22%)</p>
                                    </td>
                                    <td class="text-muted">32</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">North Carolina</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">46</span>(3.27%)</p>
                                    </td>
                                    <td class="text-muted">15</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Montana</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">17</span>(1.25%)</p>
                                    </td>
                                    <td class="text-muted">25</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Nevada</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">52</span>(3.11%)</p>
                                    </td>
                                    <td class="text-muted">71</td>
                                </tr>
                                <tr>
                                    <td class="pl-0 pb-0">Louisiana</td>
                                    <td class="pb-0">
                                        <p class="mb-0"><span class="font-weight-bold mr-2">25</span>(1.32%)</p>
                                    </td>
                                    <td class="pb-0">14</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                        <li>
                            <div class="d-flex">
                                <img src="/admin-dashboard/images/faces/face1.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Isabella Becker</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>9:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="/admin-dashboard/images/faces/face2.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Adam Warren</p>
                                    <p class="mb-0">You have done a great job #TW111</p>
                                    <small>10:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="/admin-dashboard/images/faces/face3.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Leonard Thornton</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>11:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="/admin-dashboard/images/faces/face4.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">George Morrison</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>8:50 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="/admin-dashboard/images/faces/face5.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Ryan Cortez</p>
                                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                                    <small>9:00 am</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            if ($("#alumnigender-chart").length) {
                var SalesChartCanvas = $("#alumnigender-chart").get(0).getContext("2d");
                var SalesChart = new Chart(SalesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: @json($data['alumniByGenderLabels']),
                        datasets: [{
                                label: 'Male',
                                data: @json($data['alumniMale']),
                                backgroundColor: '#98BDFF'
                            },
                            {
                                label: 'Female',
                                data: @json($data['alumniFemale']),
                                backgroundColor: '#4B49AC'
                            }
                        ]
                    },
                    options: {
                        cornerRadius: 5,
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#F2F2F2"
                                },
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#6C7383"
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: 1
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        }
                    },
                });
                document.getElementById('alumnigender-legend').innerHTML = SalesChart.generateLegend();
            }
        </script>
        <script>
            if ($("#alumni-chart").length) {
                var SalesChartCanvas = $("#alumni-chart").get(0).getContext("2d");
                var SalesChart = new Chart(SalesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: @json($data['labels']),
                        datasets: [{
                                label: 'All Alumni',
                                data: @json($data['dataAll']),
                                backgroundColor: '#98BDFF'
                            },
                            {
                                label: 'Verified Alumni',
                                data: @json($data['dataVerified']),
                                backgroundColor: '#4B49AC'
                            }
                        ]
                    },
                    options: {
                        cornerRadius: 5,
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#F2F2F2"
                                },
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#6C7383"
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: 1
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        }
                    },
                });
                document.getElementById('alumni-legend').innerHTML = SalesChart.generateLegend();
            }
        </script>
    @endpush
</x-admin-layout>
