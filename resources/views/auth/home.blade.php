<x-home-layout>
    <x-slot name="title">
        Home
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/style.css'])
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
    </x-slot>
    <div class="row">
        <div class="leftcolumn">


            <div class="card_0">
                <a class="card1" href="#">
                    <img src="images/news.png" class="news" align="left" height="164px" width="136px">
                    <h1>University News</h1>
                    <h2>Graduation 2023</h2>
                    <h6>Posted 40 minutes ago</h6>
                    <p class="small">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <div class="go-corner" href="#">
                        <div class="go-arrow">
                            →
                        </div>
                    </div>
                </a>
            </div>

            @foreach ($news as $news)
                <div class="card_0">
                    <a class="card1" href="#">
                        <img src="{{ $news->thumbnail }}" class="news" align="left" height="164px" width="136px">
                        <h1>University News</h1>
                        <h2>{{ $news->title }}</h2>
                        <h6>Posted {{ $news->created_at->diffForHumans() }}</h6>
                        <p class="small">{!! $news->description !!}</p>
                        <div class="go-corner" href="#">
                            <div class="go-arrow">
                                →
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        <div class="header-home">
            <img src="images/calendar.png" class="calendar" height="164px" width="136px">
            <h1>Events</h1>
        </div>
        <div class="rightcolumn">

            @foreach ($events as $event)
                <div class="cards">
                    <div class="image"><img src="images/prog-pic.jpg"></div>
                    <div class="content">
                        <a href="#">
                            <span class="title">
                                {{ $event->title }}
                            </span>
                        </a>
                        <hr class="solid" style="border-top: 2px solid #E9EEF2">
                        <p class="desc">
                            {{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y g:i A') }} -
                            {{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y g:i A') }}
                        </p>

                        <a class="action" href="#">
                            Find out more
                            <span aria-hidden="true">
                                →
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="header-home2">
                <img src="images/job.png" class="job" height="147px" width="143px">
                <h1>Active Job Post</h1>
            </div>

            @foreach ($jobs as $job)
                <div class="cookieCard">
                    <a href="#">
                        <p class="cookieHeading">{{ $job->job_title }}</p>
                        <hr class="solid" style="border-top: 2px solid #E9EEF2">
                        <a href="#">
                            <p class="cookieDescription">{{ $job->company }}<a href="#"></a></p>
                            <button class="acceptButton">{{ $job->status }}</button>
                </div>
            @endforeach
        </div>
    </div>
</x-home-layout>
