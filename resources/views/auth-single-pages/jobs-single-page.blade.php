<x-home-layout>
    <x-slot name="title">
        {{ $jobclass->title }}
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/job.css'])
        {{-- @vite(['resources/js/job.js']) --}}
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
    </x-slot>
    @foreach ($jobs as $job)
        <div class="detail active">
            <a href="/jobs"><ion-icon class="close-detail" name="close-outline"></ion-icon></a>
            <div class="detail-header">
                <img src="/images/chat.png">
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
        </div>
    @endforeach
</x-home-layout>
