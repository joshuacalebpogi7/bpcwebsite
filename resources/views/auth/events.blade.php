<x-home-layout>
    @push('assets')
        @vite(['resources/css/events.css'])
        @vite(['resources/js/post.js'])
    @endpush

    <section id="page-header">
        <h2>● UNIVERSITY EVENTS ●</h2>
    </section>
    <div class="svg1">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#C4E8C2"
                d="M29.6,-49.1C39.2,-45.8,48.4,-39.5,53.5,-30.8C58.5,-22.2,59.5,-11.1,59.2,-0.1C59,10.8,57.5,21.6,55.7,35.9C53.9,50.2,51.7,68,42.4,77.4C33,86.9,16.5,87.9,3.9,81.1C-8.7,74.3,-17.4,59.7,-26.4,50.1C-35.4,40.5,-44.7,35.8,-56.8,28.3C-69,20.8,-83.9,10.4,-87.5,-2C-91,-14.5,-83.1,-29,-73.3,-40.5C-63.5,-52.1,-51.8,-60.8,-39.3,-62.3C-26.7,-63.9,-13.4,-58.3,-1.7,-55.5C10,-52.6,20.1,-52.3,29.6,-49.1Z"
                transform="translate(100 100)" />
        </svg>
    </div>

    <div class="svg2">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#67D199"
                d="M48.8,-47.3C63.7,-33.9,76.5,-16.9,76.8,0.3C77.1,17.5,64.7,34.9,49.8,45.6C34.9,56.2,17.5,60,-2.5,62.5C-22.4,65,-44.8,66.1,-58.4,55.5C-72,44.8,-76.8,22.4,-73.9,2.9C-70.9,-16.5,-60.2,-33,-46.6,-46.5C-33,-60,-16.5,-70.5,0.2,-70.7C16.9,-70.9,33.9,-60.8,48.8,-47.3Z"
                transform="translate(100 100)" />
        </svg>
    </div>

    <div class="post-filter container5">

        <span class="filter-item active-filter" data-filter='all'>All</span>
        @php
            $uniqueCategories = [];
        @endphp

        @foreach ($events as $eventsCategory)
            @php
                $category = $eventsCategory->category;
                $sentenceCaseCategory = ucfirst(strtolower($category));
            @endphp

            @if (!in_array($sentenceCaseCategory, $uniqueCategories))
                <span class="filter-item" data-filter='{{ $sentenceCaseCategory }}'>{{ $sentenceCaseCategory }}</span>
                @php
                    $uniqueCategories[] = $sentenceCaseCategory;
                @endphp
            @endif
        @endforeach

    </div>

    <section class="post container5">
        @foreach ($events as $eventItem)
            <div class="post-box {{ $eventItem->category }}">
                <img src="{{ $eventItem->thumbnail }}" alt="" class="post-img">
                <h2 class="category">{{ $eventItem->category }}</h2>
                <a href="/events/{{ $eventItem->title }}" class="post-title">
                    {{ $eventItem->title }}
                </a>
                <span class="post-date">{{ $eventItem->created_at->format('F j, Y') }}</span>
                <p>
                <div class="post-description">
                    {!! $eventItem->description !!}
                </div>
                </p>

                <div class="profile">
                    <img src="{{ $eventItem->updatedBy->avatar }}" alt="" class="profile-img">
                    <span class="profile-name">{{ $eventItem->updatedBy->username }}</span>
                </div>
            </div>
        @endforeach
    </section>

    @push('footer')
        <div class="footer container5">
            <p>&#169; BPCALUMNIPORTAL All Rights Reserved</p>
            <div class="social">
                <a href="https://www.facebook.com/your_facebook_page"><i class="ri-facebook-circle-fill"></i></a>
                <a href="https://twitter.com/your_twitter_profile"><i class="ri-twitter-fill"></i></a>
                <a href="https://www.instagram.com/your_instagram_profile"><i class="ri-instagram-fill"></i></a>
                <a href="https://www.linkedin.com/in/your_linkedin_profile"><i class="ri-linkedin-box-fill"></i></a>
            </div>
        </div>
    @endpush
</x-home-layout>
