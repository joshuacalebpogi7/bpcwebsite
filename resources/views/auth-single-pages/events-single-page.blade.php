<x-home-layout>
    <x-slot name="title">
        {{ $events->title }}
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/style.css'])
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
        @vite(['resources/css/post.css'])
        @vite(['resources/js/post.js'])
    </x-slot>

    <section class="post-header">
        <div class="header-content post-container">
            <a href="{{ URL::previous() }}" class="back-home">Back</a>
            <h1 class="header-title">{{ $events->title }}</h1>
            <img src="{{ $events->thumbnail }}" alt="" class="header-img"
                style="width: 100%; height: 25rem; object-fit: cover;">
        </div>
    </section>

    <section class="post-content post-container">
        <h2 class="sub-heading">Create Best UX Design</h2>
        <p>
        <div class="post-text">{!! $events->description !!}</div>
        </p>
    </section>

    <div class="share post-container">
        <span class="share-title">Share this article</span>
        <div class="social">
            <a href="https://www.facebook.com/your_facebook_page"><i class="ri-facebook-circle-fill"></i></a>
            <a href="https://twitter.com/your_twitter_profile"><i class="ri-twitter-fill"></i></a>
            <a href="https://www.instagram.com/your_instagram_profile"><i class="ri-instagram-fill"></i></a>
            <a href="https://www.linkedin.com/in/your_linkedin_profile"><i class="ri-linkedin-box-fill"></i></a>

        </div>
    </div>
</x-home-layout>
