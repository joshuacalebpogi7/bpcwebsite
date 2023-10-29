<x-home-layout>
    <x-slot name="title">
        Jobs
    </x-slot>
    @push('assets')
        @vite(['resources/css/job.css'])
        {{-- @vite(['resources/js/job.js']) --}}
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
                    <option value="3">Most Relevant</option>
                    <option value="4">Highest Paid</option>
                </select>
            </div>
        </div>
        <div class="wrapper">
            @foreach ($jobs as $job)
                <div class="card">
                    <div class="card-left blue-bg">
                        <a href="/jobs/{{ $job->title }}"> <img src="/images/chat.png"></a>
                    </div>
                    <div class="card-center">
                        <a href="/jobs/{{ $job->title }}">
                            <h3>{{ $job->company }}</h3>
                            <p class="card-detail">{{ $job->title }}</p>
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
                                    <ion-icon name="people-outline"></ion-icon>200 Applicants
                                </p>
                            </div>
                    </div>
                    <div class="card-right">
                        <div class="card-tag">
                            <h5>Division</h5>
                            <a href="/jobs/{{ $job->title }}">{{ $job->job_title }}</a>
                        </div>
                        <div class="card-salary">
                            <p><b>$350k</b> <span>/ year</span></p>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!--right section: details jobs-->
    {{-- <div class="detail">
        <ion-icon class="close-detail" name="close-outline"></ion-icon>
        <div class="detail-header">
            <img src="images/chat.png">
            <h2>Google</h2>
            <p>Data Science</p>
        </div>
        <hr class="divider">
        <div class="detail-desc">
            <div class="about">
                <h4>About Company</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, iste rerum laudantium</p>
                <a href="#">Read more</a>
            </div>
        </div>
        <hr class="divider">
        <div class="qualification">
            <h4>Qualification</h4>
            <ul>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, iste rerum laudantium</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, iste rerum laudantium</li>
            </ul>
        </div>
        <hr class="divider">
        <div class="detail-btn">
            <button class="btn-apply">Apply Now</button>
            <button class="btn-save">Save Job</button>
        </div>
    </div> --}}

</x-home-layout>
