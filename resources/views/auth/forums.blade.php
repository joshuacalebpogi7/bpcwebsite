<x-home-layout>
    <x-slot name="title">
        Forums
    </x-slot>
    <x-slot name="assets">
        @vite(['resources/css/style.css'])
        @vite(['resources/css/styles.css'])
        @vite(['resources/js/main.js'])
    </x-slot>
    <section id="page-header">
        <h2>● FORUM / DISCUSSION ●</h2>
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
    <section class="p-category">
        <a href="#">START A NEW DISCUSSION</a>
    </section>
    <div class="box-category">

        <div class="notifications-container">
            <div class="dad-joke">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <img src="images/category.png" width="30px">
                    </div>
                    <div class="dad-joke-prompt-wrap">
                        <p class="dad-joke-prompt-heading">Category</p>
                        <div class="dad-joke-prompt">
                            <hr class="solid" style="border-top: 2px solid #498d69">
                            <p>All Discussions</p>
                            <p>General Discussions</p>
                            <p>Help</p>
                            <p>Blog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notifications-container1">
            <div class="dad-joke1">
                <div class="flex1">
                    <div class="flex-shrink-01">
                        <img src="images/dialog.png" width="30px">
                    </div>
                    <div class="dad-joke-prompt-wrap1">
                        <p class="dad-joke-prompt-heading1">Category</p>
                        <div class="dad-joke-prompt1">
                            <hr class="solid" style="border-top: 2px solid #9062b9">
                            <p>Capstone Prototype</p>
                            <p>Graduation Ball</p>
                            <p>IT Night for Bpc</p>
                            <p>Sleep Deprivation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="ibox-content forum-container">

                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">General Discussion</a>
                                    <div class="forum-sub-title">Talk about sports, entertainment, music, movies, your
                                        favorite color, talk about enything.</div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        1216
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">Introductions</a>
                                    <div class="forum-sub-title">New to the community? Please stop by, say hi and tell
                                        us a bit about yourself. </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        890
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">Announcements</a>
                                    <div class="forum-sub-title">This forum features announcements from the community
                                        staff. If there is a new post in this forum, please check it out. </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        680
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">Staff Discussion</a>
                                    <div class="forum-sub-title">This forum is for private, staff member only
                                        discussions, usually pertaining to the community itself. </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        1450
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">Lorem Ipsum is simply dummy text.
                                    </a>
                                    <div class="forum-sub-title">Various versions have evolved over the years, sometimes
                                        by accident, sometimes on purpose passage of Lorem Ipsum (injected humour and
                                        the like).</div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        1516
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">There are many variations of
                                        passages</a>
                                    <div class="forum-sub-title"> If you are going to use a passage of Lorem Ipsum, you
                                        need to be sure there isn't anything embarrassing hidden in the middle of text.
                                        All the Lorem Ipsum generators on the . </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        1766
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="forum_post.php" class="forum-item-title">The standard chunk of Lorem
                                        Ipsum</a>
                                    <div class="forum-sub-title">Ipsum generators on the Internet tend to repeat
                                        predefined chunks as necessary, making this the first true generator on the
                                        Internet.</div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        765
                                    </span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
