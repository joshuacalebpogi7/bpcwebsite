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
            <div class="card tale-bg" style="background-color: #e9f6ef; !important">
                <div class="card-people mt-auto">
                    <img src="/images/newbg.png" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-bolder text-info"><i
                                        class="icon-sun mr-2"></i>{{ date('d') }}
                                </h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-bolder text-info">{{ date('F') }}</h4>
                                <h6 class="font-weight-bold text-info">{{ date('l') }}</h6>
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
                            <p>
                                @if ($data['courses']->count() > 0)
                                    {{ number_format($data['verifiedAlumni']->whereNotNull('course')->count() / $data['courses']->count(), 2) }}
                                    (Average alumni in each course)
                                @endif
                            </p>
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
                    <p class="font-weight-500">This chart provides a visual breakdown of
                        the
                        gender distribution of
                        alumni in various courses. Only alumni with
                        confirmed email
                        addresses (verified) are included in the data for this chart.</span>
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
                    <p class="font-weight-500">This chart displays the overall number of
                        alumni and how many are purely
                        verified alumni in each course. All alumni, verified or not verified are included in the data
                        for this chart.</p>
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
                                            <p class="mb-2 mb-xl-0">This chart provides two visual graphs: <span
                                                    class="text-info">The graph
                                                    where it shows the different courses</span>
                                                illustrates the total number of <em>employed</em>
                                                alumni on each
                                                course. (The <span class="text-info">blue progress bar</span> shows the
                                                percentage of what course has
                                                the most and least <em>employed</em> alumni) The <span
                                                    class="text-info">pie chart</span> shows
                                                the gender
                                                distribution for
                                                <em>employed</em> alumni. Only alumni
                                                with confirmed email addresses (verified) are included in the data
                                                for
                                                this chart.
                                            </p>
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
                        @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'employed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'employed')->count() /$data['verifiedAlumni']->where('employment_status', 'employed')->count()) *100 }}% @else 0% @endif "
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
                                                <canvas id="employed-chart"></canvas>
                                                <div id="employed-legend"></div>
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
                                            <p class="mb-2 mb-xl-0">This chart provides two visual graphs: <span
                                                    class="text-info">The graph
                                                    where it shows the different courses</span>
                                                illustrates the total number of <em>unemployed</em>
                                                alumni on each
                                                course. (The <span class="text-info">blue progress bar</span> shows
                                                the
                                                percentage of what course has
                                                the most and least <em>unemployed</em> alumni) The <span
                                                    class="text-info">pie chart</span> shows
                                                the gender
                                                distribution for
                                                <em>unemployed</em> alumni. Only alumni
                                                with confirmed email addresses (verified) are included in the data
                                                for
                                                this chart.
                                            </p>
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
                                                                            style="width: @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'unemployed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'unemployed')->count() /$data['verifiedAlumni']->where('employment_status', 'unemployed')->count()) *100 }}%  @else 0% @endif"
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
                                                <canvas id="unemployed-chart"></canvas>
                                                <div id="unemployed-legend"></div>
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
                                            <p class="mb-2 mb-xl-0">This chart provides two visual graphs: <span
                                                    class="text-info">The graph
                                                    where it shows the different courses</span>
                                                illustrates the total number of <em>self-employed</em>
                                                alumni on each
                                                course. (The <span class="text-info">blue progress bar</span> shows
                                                the
                                                percentage of what course has
                                                the most and least <em>self-employed</em> alumni) The <span
                                                    class="text-info">pie chart</span> shows
                                                the gender
                                                distribution for
                                                <em>self-employed</em> alumni. Only alumni
                                                with confirmed email addresses (verified) are included in the data
                                                for
                                                this chart.
                                            </p>
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
                                                                            style="width: @if ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'self-employed')->count() > 0) {{ ($data['verifiedAlumni']->where('course', $course->course)->where('employment_status', 'self-employed')->count() /$data['verifiedAlumni']->where('employment_status', 'self-employed')->count()) *100 }}% @else 0% @endif"
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
                                                <canvas id="self-employed-chart"></canvas>
                                                <div id="self-employed-legend"></div>
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
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-title mb-0">Latest Alumni</p>
                        <a href="/admin/users" class="text-info">View all</a>
                    </div>
                    <p class="font-weight-400 mt-3">This table shows the list of the 10 latest alumni. Only alumni
                        with confirmed email addresses (verified) are included in the data
                        for
                        this table.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['verifiedAlumni'] as $key => $alumni)
                                    @if ($key < 10)
                                        <tr>
                                            <td>{{ $alumni->first_name . ' ' . $alumni->last_name }}</td>
                                            <td class="font-weight-bold">{{ $alumni->course }}</td>
                                            <td>{{ $alumni->year_graduated }}</td>
                                            <td class="font-weight-medium">
                                                <div
                                                    class="badge 
                                        @if ($alumni->employment_status == 'employed') badge-success 
                                        @elseif ($alumni->employment_status == 'self-employed')
                                        badge-info
                                        @else
                                        badge-danger @endif">
                                                    {{ $alumni->employment_status }}</div>
                                            </td>
                                        </tr>
                                    @else
                                    @break
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Alumni by Batch</p>
                    {{-- <a href="#" class="text-info">View all</a> --}}
                </div>
                <p class="font-weight-500">This chart shows the employment status of all alumni by batch where
                    employed and self-employed is considered employed. Only alumni
                    with confirmed email addresses (verified) are included in the data
                    for
                    this chart.</p>
                <div id="alumnibatch-legend" class="chartjs-legend mt-4 mb-2"></div>
                <canvas id="alumnibatch-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title mb-0">Alumni Jobs Relation to Course</p>
                    {{-- <a href="/admin/users" class="text-info">View all</a> --}}

                </div>
                <p class="font-weight-400 mt-3">This table shows the list of 10 latest employed and self-employed
                    alumni.
                    <span class="text-success">green status</span> means employed and <span class="text-info">blue
                        status</span> means self-employed. This table shows if the job of the alumni is related to
                    his/her course or not. Only alumni who is not unemployed
                    are included in the data for this table.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Job</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['allAlumniWithJobs'] as $key => $alumniCollection)
                                @if ($key < 10)
                                    @foreach ($alumniCollection as $key => $alumni)
                                        @if ($key < 10)
                                            <tr>
                                                <td>{{ $alumni->first_name . ' ' . $alumni->last_name }}
                                                </td>
                                                <td class="font-weight-bold">{{ $alumni->course }}</td>
                                                <td>{{ $alumni->job_title }}</td>
                                                <td class="font-weight-medium">
                                                    <div
                                                        class="badge @if ($alumni->employment_status == 'employed') badge-success @elseif ($alumni->employment_status == 'self-employed') badge-info @else badge-danger @endif">

                                                        @if ($alumni->employment_status == 'unemployed')
                                                            unemployed
                                                        @endif
                                                        @foreach ($data['jobUnrelatedAlumni'] as $collection)
                                                            @foreach ($collection as $jobUnrelatedAlumnus)
                                                                @if ($alumni->id == $jobUnrelatedAlumnus->id)
                                                                    unrelated
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        @foreach ($data['jobRelatedAlumni'] as $collection)
                                                            @foreach ($collection as $jobRelatedAlumnus)
                                                                @if ($alumni->id == $jobRelatedAlumnus->id)
                                                                    related
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                        @break
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <p class="card-title">Job Related to Course</p>
                {{-- <a href="#" class="text-info">View all</a> --}}
            </div>
            <p class="font-weight-500">This chart provides visual graphs for all employed and self-employed
                alumni. It shows the number of alumni whose job is related to
                his/her course or not. Only alumni who is not unemployed
                are included in the data for this chart.
            </p>
            <div id="jobrelated-legend" class="chartjs-legend mt-4 mb-2"></div>
            <canvas id="jobrelated-chart"></canvas>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6 stretch-card grid-margin">
    <div class="card">
        <div class="card-body">
            <p class="card-title mb-3">Courses</p>
            <p class="font-weight-400">This table displays the total number of
                alumni and the percentage of
                verified alumni in each course. All alumni, verified or not verified are included in the data
                for this table.</p>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="pl-0  pb-2 border-bottom">Course</th>
                            <th class="pl-0  pb-2 border-bottom">Course Name</th>
                            <th class="border-bottom pb-2">Verified Alumni (%)</th>
                            <th class="border-bottom pb-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['courses'] as $key => $course)
                            @if ($key < 10)
                                <tr>
                                    <td class="pl-0">{{ $course->course }}</td>
                                    <td class="pl-0">{{ $course->description }}</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">

                                                {{ $data['users']->where('course', $course->course)->whereNotNull('email_verified_at')->count() }}
                                            </span>(
                                            @if ($data['users']->where('course', $course->course)->whereNotNull('email_verified_at')->count() <= 0)
                                                0%
                                            @else
                                                {{ number_format(($data['users']->where('course', $course->course)->whereNotNull('email_verified_at')->count() /$data['users']->where('course', $course->course)->count()) *100,2) }}%
                                            @endif
                                            )
                                        </p>
                                    </td>
                                    <td class="text-muted">
                                        {{ $data['users']->where('course', $course->course)->count() }}
                                    </td>
                                </tr>
                            @else
                            @break
                        @endif
                    @endforeach

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
            {{-- @if (!empty($data['logs']))
                @foreach ($data['logs'] as $log)
                @php
                    $log_user = $data['users']->find($log->log_author);
                @endphp
                    <li>
                        <div class="d-flex">
                            <img src="{{ $log_user->avatar }}" alt="user">
                            <div>
                                <p class="text-info mb-1">{{ $log_user->first_name }} {{ $log_user->last_name }}
                                </p>
                                <p class="mb-0">{{ $log->loggedBody }}</p>
                                <small>{{ $log->created_at->diffForHumans() }}<br>{{ $log->created_at->format('D, M j, Y g:i A') }}</small>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif --}}
        </ul>
    </div>
</div>
</div>
</div>

@push('scripts')
<script>
    if ($("#employed-chart").length) {
        var areaData = {
            labels: ["Male", "Female"],
            datasets: [{
                data: [@json($data['maleEmployedCount']),
                    @json($data['femaleEmployedCount'])
                ],
                backgroundColor: [
                    "#1fc7ff", "#ff9eb3",
                ],
                // borderColor: "rgba(0,0,0,0)"
            }]
        };
        var areaOptions = {
            responsive: true,
            maintainAspectRatio: true,
            segmentShowStroke: false,
            cutoutPercentage: 78,
            elements: {
                arc: {
                    borderWidth: 4
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            legendCallback: function(chart) {
                var text = [];
                text.push('<div class="report-chart">');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[0] +
                    '"></div><p class="mb-0">Male Employed</p></div>');
                text.push('<p class="mb-0">' + @json($data['maleEmployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[1] +
                    '"></div><p class="mb-0">Female Employed</p></div>');
                text.push('<p class="mb-0">' + @json($data['femaleEmployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push('</div>');
                return text.join("");
            },
        }
        var northAmericaChartPlugins = {
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;

                ctx.restore();
                var fontSize = 3.125;
                ctx.font = "500 " + fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                ctx.fillStyle = "#13381B";

                var text = @json($data['totalEmployedCount']),
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }
        var northAmericaChartCanvas = $("#employed-chart").get(0).getContext("2d");
        var northAmericaChart = new Chart(northAmericaChartCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions,
            plugins: northAmericaChartPlugins
        });
        document.getElementById('employed-legend').innerHTML = northAmericaChart.generateLegend();
    }
</script>
<script>
    if ($("#unemployed-chart").length) {
        var areaData = {
            labels: ["Male", "Female"],
            datasets: [{
                data: [@json($data['maleUnemployedCount']),
                    @json($data['femaleUnemployedCount'])
                ],
                backgroundColor: [
                    "#1fc7ff", "#ff9eb3",
                ],
                // borderColor: "rgba(0,0,0,0)"
            }]
        };
        var areaOptions = {
            responsive: true,
            maintainAspectRatio: true,
            segmentShowStroke: false,
            cutoutPercentage: 78,
            elements: {
                arc: {
                    borderWidth: 4
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            legendCallback: function(chart) {
                var text = [];
                text.push('<div class="report-chart">');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[0] +
                    '"></div><p class="mb-0">Male Unemployed</p></div>');
                text.push('<p class="mb-0">' + @json($data['maleUnemployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[1] +
                    '"></div><p class="mb-0">Female Unemployed</p></div>');
                text.push('<p class="mb-0">' + @json($data['femaleUnemployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push('</div>');
                return text.join("");
            },
        }
        var northAmericaChartPlugins = {
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;

                ctx.restore();
                var fontSize = 3.125;
                ctx.font = "500 " + fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                ctx.fillStyle = "#13381B";

                var text = @json($data['totalUnemployedCount']),
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }
        var northAmericaChartCanvas = $("#unemployed-chart").get(0).getContext("2d");
        var northAmericaChart = new Chart(northAmericaChartCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions,
            plugins: northAmericaChartPlugins
        });
        document.getElementById('unemployed-legend').innerHTML = northAmericaChart.generateLegend();
    }
</script>
<script>
    if ($("#self-employed-chart").length) {
        var areaData = {
            labels: ["Male", "Female"],
            datasets: [{
                data: [@json($data['maleSelfEmployedCount']),
                    @json($data['femaleSelfEmployedCount'])
                ],
                backgroundColor: [
                    "#1fc7ff", "#ff9eb3",
                ],
                // borderColor: "rgba(0,0,0,0)"
            }]
        };
        var areaOptions = {
            responsive: true,
            maintainAspectRatio: true,
            segmentShowStroke: false,
            cutoutPercentage: 78,
            elements: {
                arc: {
                    borderWidth: 4
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            legendCallback: function(chart) {
                var text = [];
                text.push('<div class="report-chart">');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[0] +
                    '"></div><p class="mb-0">Male Self Employed</p></div>');
                text.push('<p class="mb-0">' + @json($data['maleSelfEmployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push(
                    '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                    chart.data.datasets[0].backgroundColor[1] +
                    '"></div><p class="mb-0">Female Self Employed</p></div>');
                text.push('<p class="mb-0">' + @json($data['femaleSelfEmployedCount']) +
                    '</p>');
                text.push('</div>');
                text.push('</div>');
                return text.join("");
            },
        }
        var northAmericaChartPlugins = {
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;

                ctx.restore();
                var fontSize = 3.125;
                ctx.font = "500 " + fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                ctx.fillStyle = "#13381B";

                var text = @json($data['totalSelfEmployedCount']),
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }
        var northAmericaChartCanvas = $("#self-employed-chart").get(0).getContext("2d");
        var northAmericaChart = new Chart(northAmericaChartCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions,
            plugins: northAmericaChartPlugins
        });
        document.getElementById('self-employed-legend').innerHTML = northAmericaChart.generateLegend();
    }
</script>
<script>
    if ($("#jobrelated-chart").length) {
        var SalesChartCanvas = $("#jobrelated-chart").get(0).getContext("2d");
        var SalesChart = new Chart(SalesChartCanvas, {
            type: 'bar',
            data: {
                labels: @json($data['jobRelatedLabels']),
                datasets: [{
                        label: 'Related',
                        data: @json($data['jobRelatedCounts']),
                        backgroundColor: '#1fc7ff'
                    },
                    {
                        label: 'Not Related',
                        data: @json($data['jobUnrelatedCounts']),
                        backgroundColor: '#ff3d3d'
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
                        ticks: {
                            beginAtZero: true,
                            fontColor: "#6C7383",
                            stepSize: 1, // Set the step size to 1 to display whole numbers
                        }
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
        document.getElementById('jobrelated-legend').innerHTML = SalesChart.generateLegend();
    }
</script>
<script>
    if ($("#alumnibatch-chart").length) {
        var SalesChartCanvas = $("#alumnibatch-chart").get(0).getContext("2d");
        var SalesChart = new Chart(SalesChartCanvas, {
            type: 'bar',
            data: {
                labels: @json($data['alumniByBatchLabels']),
                datasets: [{
                        label: 'Employed',
                        data: @json($data['employedByBatch']),
                        backgroundColor: '#1fc7ff'
                    },
                    {
                        label: 'Unemployed',
                        data: @json($data['unemployedByBatch']),
                        backgroundColor: '#ff3d3d'
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
                        ticks: {
                            beginAtZero: true,
                            fontColor: "#6C7383",
                            stepSize: 1, // Set the step size to 1 to display whole numbers
                        }
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
        document.getElementById('alumnibatch-legend').innerHTML = SalesChart.generateLegend();
    }
</script>
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
                        backgroundColor: '#1fc7ff'
                    },
                    {
                        label: 'Female',
                        data: @json($data['alumniFemale']),
                        backgroundColor: '#ff9eb3'
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
                        ticks: {
                            beginAtZero: true,
                            fontColor: "#6C7383",
                            stepSize: 1, // Set the step size to 1 to display whole numbers
                        }
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
                        backgroundColor: '#1fc7ff'
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
                        ticks: {
                            beginAtZero: true,
                            fontColor: "#6C7383",
                            stepSize: 1, // Set the step size to 1 to display whole numbers
                        }
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
