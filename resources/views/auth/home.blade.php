<x-home-layout>
    <x-slot:title>
        Home
    </x-slot:title>
    <h2>Welcome <span>{{ auth()->user()->username }}</span> to HomePage!</h2>
    <div class="row">
        <div class="leftcolumn">
            <div class="card_0">
                <a class="card1" href="#">
                    <img src="images/news.png" class="news" align="left" height="164px" width="136px">
                    <h1>University News</h1>
                    <h2>PROMOTE SELF-CONFIDENCE</h2>
                    <h6>Posted 20 minutes ago</h6>
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

            <div class="card_0">
                <a class="card1" href="#">
                    <img src="images/news.png" class="news" align="left" height="164px" width="136px">
                    <h1>University News</h1>
                    <h2>MLBB WINNERS</h2>
                    <h6>Posted 1 hour ago</h6>
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

            <div class="card_0">
                <a class="card1" href="#">
                    <img src="images/news.png" class="news" align="left" height="164px" width="136px">
                    <h1>University News</h1>
                    <h2>PROMOTE SELF-CONFIDENCE</h2>
                    <h6>Posted 20 minutes ago</h6>
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

        </div>
        <div class="header-home">
            <img src="images/calendar.png" class="calendar" height="164px" width="136px">
            <h1>Events</h1>
        </div>
        <div class="rightcolumn">
            <div class="cards">
                <div class="image"><img src="images/prog-pic.jpg"></div>
                <div class="content">
                    <a href="#">
                        <span class="title">
                            Programming Contest
                        </span>
                    </a>
                    <hr class="solid" style="border-top: 2px solid #E9EEF2">
                    <p class="desc">
                        Posted March 13, 2023
                    </p>

                    <a class="action" href="#">
                        Find out more
                        <span aria-hidden="true">
                            →
                        </span>
                    </a>
                </div>
            </div>

            <div class="header-home2">
                <img src="images/job.png" class="job" height="147px" width="143px">
                <h1>Active Job Post</h1>
            </div>

            <div class="cookieCard">
                <a href="#">
                    <p class="cookieHeading">Senior Developer</p>
                    <hr class="solid" style="border-top: 2px solid #E9EEF2">
                    <a href="#">
                        <p class="cookieDescription">Accenture BGC<a href="#"></a></p>
                        <button class="acceptButton">Full-time</button>
            </div>


        </div>
    </div>
    </x-layout>
