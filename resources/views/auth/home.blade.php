<x-home-layout>
    <x-slot name="title">
        Home
    </x-slot>
    <section id="page-header">
        <h2 style="color: #fafafa">● HOME ●</h2>
    </section>
    <div class="row">
        <div class="leftcolumn">


            @foreach ($news as $index => $news)
                @if ($index < 7)
                    <div class="card_0">
                        <a class="card1" href="/news/{{ $news->title }}">
                            <img src="/images/news.png" class="news" align="left" height="120px" width="100px">
                            <h1>University News</h1>
                            <h2>{{ $news->title }}</h2>
                            <h6>Posted {{ $news->created_at->diffForHumans() }}</h6>
                            <p class="small"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 200px;">
                                {!! $news->description !!}</p>
                            <div class="go-corner" href="#">
                                <div class="go-arrow">
                                    →
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach

        </div>
        <div class="header-home">
            <img src="images/calendar.png" class="calendar" height="98px" width="110px">
            <h1>Events</h1>
        </div>
        <div class="rightcolumn">

            @foreach ($events as $index => $event)
                @if ($index < 3)
                    <div class="cards">
                        <div class="image"><img src="images/prog-pic.jpg"></div>
                        <div class="content">
                            <a href="/events/{{ $event->title }}">
                                <span class="title">
                                    {{ $event->title }}
                                </span>
                            </a>
                            <hr class="solid" style="border-top: 2px solid #E9EEF2">
                            <p class="desc">
                                {{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y g:i A') }} -
                                {{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y g:i A') }}
                            </p>
                            <a class="action" href="/events/{{ $event->title }}">
                                Find out more
                                <span aria-hidden="true">
                                    →
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach



            <div class="header-home2">
                <img src="images/job.png" class="job" height="100px" width="98px">
                <h1>Active Job Post</h1>
            </div>

            @foreach ($jobs as $index => $job)
                @if ($index < 3)
                    <div class="cookieCard">
                        <a href="/jobs/{{ $job->title }}">
                            <p class="cookieHeading">{{ $job->job_title }}</p>
                            <hr class="solid" style="border-top: 2px solid #E9EEF2">
                            <a href="/jobs/{{ $job->title }}">
                                <p class="cookieDescription">{{ $job->company }}<a
                                        href="/jobs/{{ $job->title }}"></a></p>
                                <button class="acceptButton">{{ $job->job_type }}</button>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @push('footer')
        <div class="footer container5">
            <p>&#169; ALUMNIPORTAL All Rights Reserved</p>
            <div class="social">
                <a href="https://www.facebook.com/your_facebook_page"><i class="ri-facebook-circle-fill"></i></a>
                <a href="https://twitter.com/your_twitter_profile"><i class="ri-twitter-fill"></i></a>
                <a href="https://www.instagram.com/your_instagram_profile"><i class="ri-instagram-fill"></i></a>
                <a href="https://www.linkedin.com/in/your_linkedin_profile"><i class="ri-linkedin-box-fill"></i></a>
            </div>
        </div>
    @endpush
</x-home-layout>
