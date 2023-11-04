<!-- resources/views/livewire/forum-list.blade.php -->
<script>
    function confirmDeleteForum(forumData) {
        if (confirm('Are you sure you want to delete "' + forumData.forumTitle + '"?')) {
            // If the user confirms, redirect to the delete route
            window.location.href = "/delete_forum/" + forumData.id;
        }
    }
</script>

<title>Forums</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<section id="page-header">
    <h2 style="color: #fafafa">● FORUM / DISCUSSION ●</h2>
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
    <a href="{{ url('new_forum') }}" style="color: #fafafa">START A NEW DISCUSSION</a>
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
                        <div class="col-md-1 forum-infos">
                            {{--                             @php
                                $categoryCounts = []; // Initialize an array to store category counts
                            @endphp

                            @foreach ($forum_list as $forum_posted)
                                @php
                                    $category = $forum_posted->forumCategory;
                                    $categoryCounts[$category] = ($categoryCounts[$category] ?? 0) + 1;
                                @endphp
                            @endforeach

                            @php
                                arsort($categoryCounts);
                                $topCategories = array_slice($categoryCounts, 0, 4);
                            @endphp

                            @foreach ($topCategories as $category => $count)
                                <p>{{ $category }}: <span class="numbers">{{ $count }}</span></p>
                            @endforeach --}}
                            @foreach ($popularCategories as $category)
                                <p>{{ $category->forumCategory }}
                                    <span class="numbers">({{ $category->discussions_count }})</span>
                                </p>
                            @endforeach
                        </div>
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
                    <p class="dad-joke-prompt-heading1">Popular Discussion</p>
                    <div class="dad-joke-prompt1">
                        <hr class="solid" style="border-top: 2px solid #9062b9">

                        {{--                         @foreach ($forum_list as $forum_posted)
                            @foreach ($forum_replies as $forum_reply)
                                @if ($forum_reply->parentForum == $forum_posted->id)

                                @endif
                            @endforeach
                        @endforeach --}}
                        @foreach ($popularDiscussion as $title)
                            <p><a
                                    href = "{{ route('view_forum', ['forum_selected' => $title->id]) }}">{{ $title->forumTitle }}</a>
                                {{-- (Replies: {{ $title->replies_count }}) --}}</p>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="padding: 30px;">
    <div class="row">
        <hr style = "border: solid 1px #57b657;">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content forum-container">
                    @if (!$forum_list->isEmpty())
                        @php
                            $allForumsInactive = true;
                        @endphp

                        @foreach ($forum_list as $forum_posted)
                            {{-- @if ($forum_posted['active'] > 0) --}}
                            @php
                                $count = 0; // Initialize a count variable
                                $allForumsInactive = false;
                            @endphp
                            @foreach ($forum_replies as $forum_reply)
                                @if ($forum_reply->parentForum === $forum_posted->id)
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            @endforeach
                            {{-- @endif --}}
                            <div class="forum-item">
                                <div style = "text-align: right;">
                                    @if ($forum_posted->forumAuthor == auth()->user()->id)
                                        <button type="button" class="btn btn-danger btn-icon-text"
                                            style="width: 150px; height: 50px; margin: 5px;"
                                            onclick="confirmDeleteForum({{ json_encode($forum_posted) }})">
                                            <i class="ti-trash btn-icon-prepend"></i>
                                            Delete
                                        </button>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="forum-icon">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <small>{{ $forum_posted->forumCategory }}</small>
                                        <a href="{{ route('view_forum', ['forum_selected' => $forum_posted->id]) }}"
                                            class="forum-item-title">{{ $forum_posted->forumTitle }}</a>
                                        <div class="forum-sub-title">
                                            {{ $forum_posted->forumBody }}<br><small>Posted by:<br>
                                                @php
                                                    $user = $users->firstWhere('id', $forum_posted->forumAuthor);
                                                @endphp
                                                {{ $user ? ($user->first_name !== $user->last_name ? $user->first_name . ' ' . $user->last_name : $user->first_name) : 'Author not found' }}
                                                @if ($forum_posted->forumAuthor == auth()->user()->id)
                                                    (You)
                                                @endif
                                            </small>
                                        </div>

                                    </div>
                                    <div class="col-md-1 forum-info">
                                        <span class="views-number">
                                            {{ $count }}
                                        </span>
                                        <div>
                                            <small>Comments</small>
                                        </div>
                                    </div>
                                </div>
                                <hr style = "border: solid 1px #57b657;">

                            </div>
                        @endforeach

                        @if ($allForumsInactive)
                            <p>No forum posts available.</p>
                        @endif
                    @else
                        <p>No forum posts available.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
