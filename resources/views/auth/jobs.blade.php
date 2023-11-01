<x-home-layout>
    <x-slot name="title">
        Jobs
    </x-slot>
    @push('assets')
        @vite(['resources/css/job.css'])
    @endpush

    <div class="main-5">
        <div class="main-header">
            <ion-icon class="menu-bar" name="menu-outline"></ion-icon>
            <div class="search">
                <input type="text" placeholder="Search your best job here...">
                <button class="btn-search">
                    <ion-icon name="search-outline">
                </button>
            </div>
        </div>
        <div class="filter-wrapper">
        </div>
        <div class="sort">
            <p>Sort</p>
            <div class="sort-list">
                <select>
                    <option value="0">All</option>
                    <option value="1">Newest Post</option>
                    <option value="2">Oldest Post</option>
                </select>
            </div>
        </div>
        <div class="wrapper">
            @foreach ($jobs as $job)
                <div class="card">
                    <div class="card-left blue-bg">
                        <a href="/jobs/{{ $job->job_title }}"> <img src="/images/job.png"></a>
                    </div>
                    <div class="card-center">
                        <a href="/jobs/{{ $job->job_title }}">
                            <h3>{{ $job->company }}</h3>
                            <p class="card-detail">{{ $job->job_title }}</p>
                            <p class="card-loc">
                                <ion-icon name="location-outline"></ion-icon>{{ $job->company }}
                            </p>
                            <div class="card-sub">
                                <p>
                                    <ion-icon name="today-outline"></ion-icon>{{ $job->created_at->diffForHumans() }}
                                </p>
                                <p>
                                    <ion-icon name="hourglass-outline"></ion-icon>{{ $job->job_type }}
                                </p>
                                <p>
                                    {{-- @php
                                        dd($userJobs->where('job_id', $job->id)->count());
                                    @endphp --}}
                                    <ion-icon
                                        name="people-outline"></ion-icon>{{ $userJobs->where('job_id', $job->id)->count() }}
                                    Applicants
                                </p>
                            </div>
                    </div>
                    <div class="card-right">
                        <div class="card-tag">
                            <h5>Division</h5>
                            <a href="/jobs/{{ $job->job_title }}">{{ $job->job_title }}</a>
                        </div>
                        <div class="card-salary">
                            <p><b>@php
                                $salary = $job->salary;
                                if ($salary >= 1000000) {
                                    $formattedSalary = '₱' . number_format($salary / 1000000) . 'm';
                                } elseif ($salary >= 1000) {
                                    $formattedSalary = '₱' . number_format($salary / 1000) . 'k';
                                } else {
                                    $formattedSalary = '₱' . number_format($salary, 0, '', ',');
                                }
                            @endphp
                                    {{ $formattedSalary }}</b> <span>/ year</span></p>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--right section: details jobs-->


</x-home-layout>
