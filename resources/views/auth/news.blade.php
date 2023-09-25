<x-home-layout>
    <x-slot name="title">
        News
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/style.css'])
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
    </x-slot>

    <section id="page-header">
        <h2>● UNIVERSITY NEWS ●</h2>
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

    <section class="tab">

        <article class="blog-post">
            <div class="blog-post__img">
                <img src="images/goal-pic.jpg" alt="">
            </div>
            <div class="blog-post__info">
                <h2 class="blog-post__title">SELF-CONFIDENCE</h2>
                <div class="blog-post__date">
                    <span>Posted 20 minutes ago</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                <a href="#" class="blog-post__cta">Read More ></a>
            </div>
        </article>

        @foreach ($news as $news)
            <article class="blog-post">
                <div class="blog-post__img">
                    <img src="{{ $news->thumbnail }}" alt="">
                </div>
                <div class="blog-post__info">
                    <h2 class="blog-post__title">{{ $news->title }}</h2>
                    <div class="blog-post__date">
                        <span>Posted {{ $news->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{!! $news->description !!}</p>
                    <a href="#" class="blog-post__cta">Read More ></a>
                </div>
            </article>
        @endforeach

    </section>
</x-home-layout>
