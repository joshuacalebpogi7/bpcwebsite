<x-home-layout>
    <x-slot name="title">
        Jobs
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/job.css'])
        @vite(['resources/js/job.js'])
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
    </x-slot>
    <!--main-->
    <div class="main-5">
        <div class="main-header">
            <ion-icon class="menu-bar" name="menu-outline"></ion-icon>
            <div class="search">
                <input type="text" placeholder="Search your best job here...">
                <button class="btn-search"><ion-icon name="search-outline"></button>
            </div>
        </div>
        <div class="filter-wrapper">
            <p>Recommendation</p>
            <div class="filter">
                <button class="btn-filter">Data Science</button>
                <button class="btn-filter">Data Engineer</button>
                <button class="btn-filter">Data Analyst</button>
                <button class="btn-filter">Data Visualization</button>
                <button class="btn-filter">CRM Analyst</button>
            </div>
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
            <div class="card">
                <div class="card-left blue-bg">
                    <img src="images/chat.png">
                </div>
                <div class="card-center">
                    <h3>Google</h3>
                    <p class="card-detail">Data Science, Data Engineer</p>
                    <p class="card-loc"><ion-icon name="location-outline"></ion-icon>Abcd street</p>
                    <div class="card-sub">
                        <p><ion-icon name="today-outline"></ion-icon>1 mins ago</p>
                        <p><ion-icon name="hourglass-outline"></ion-icon>Full-time</p>
                        <p><ion-icon name="people-outline"></ion-icon>200 Applicants</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="card-tag">
                        <h5>Division</h5>
                        <a href="#">Data Engineer</a>
                    </div>
                    <div class="card-salary">
                        <p><b>$350k</b> <span>/ year</span></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-left yellow-bg">
                    <img src="images/desktop.png">
                </div>
                <div class="card-center">
                    <h3>Tiktok</h3>
                    <p class="card-detail">Data Analytics, Product Analyst</p>
                    <p class="card-loc"><ion-icon name="location-outline"></ion-icon>Abcd street</p>
                    <div class="card-sub">
                        <p><ion-icon name="today-outline"></ion-icon>10 mins ago</p>
                        <p><ion-icon name="hourglass-outline"></ion-icon>Full-time</p>
                        <p><ion-icon name="people-outline"></ion-icon>130 Applicants</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="card-tag">
                        <h5>Division</h5>
                        <a href="#">Data Science</a>
                    </div>
                    <div class="card-salary">
                        <p><b>$200k</b> <span>/ year</span></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-left red-bg">
                    <img src="images/news.png">
                </div>
                <div class="card-center">
                    <h3>Youtube</h3>
                    <p class="card-detail">Data Analyst, Product Analyst</p>
                    <p class="card-loc"><ion-icon name="location-outline"></ion-icon>Abcd street</p>
                    <div class="card-sub">
                        <p><ion-icon name="today-outline"></ion-icon>1 hour ago</p>
                        <p><ion-icon name="hourglass-outline"></ion-icon>Full-time</p>
                        <p><ion-icon name="people-outline"></ion-icon>240 Applicants</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="card-tag">
                        <h5>Division</h5>
                        <a href="#">Engineer, Product</a>
                    </div>
                    <div class="card-salary">
                        <p><b>$485k</b> <span>/ year</span></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-left purple-bg">
                    <img src="images/job.png">
                </div>
                <div class="card-center">
                    <h3>Apple</h3>
                    <p class="card-detail">UI UX Designer</p>
                    <p class="card-loc"><ion-icon name="location-outline"></ion-icon>Abcd street</p>
                    <div class="card-sub">
                        <p><ion-icon name="today-outline"></ion-icon>1 mins ago</p>
                        <p><ion-icon name="hourglass-outline"></ion-icon>Full-time</p>
                        <p><ion-icon name="people-outline"></ion-icon>175 Applicants</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="card-tag">
                        <h5>Division</h5>
                        <a href="#">Designer App</a>
                    </div>
                    <div class="card-salary">
                        <p><b>$230k</b> <span>/ year</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--right section: details jobs-->
    <div class="detail">
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
    </div>

</x-home-layout>
