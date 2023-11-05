@if (auth()->user()->user_type != 'alumni')
    <div class = "container5">
        <header class="header">
            <h1 id="title" class="text-center">Edit {{ $forum_selected->forumTitle }}</h1>
            {{-- <label id="name-label">Survey Type</label>
         <select class="form-control" wire:model="surveyType">
            <option disabled selected value="">Choose type</option>
            <option value="Built_in">Built-in</option>
            <option value="Google_form">Google Forms</option>
        </select> --}}
        </header>
        <form id="survey-form" wire:submit.prevent="updateForumPost">
            @csrf
            <div class="form-group">
                <label>
                    <input type="checkbox" class = "input-checkbox" id="active" wire:model="active">Active
                </label>
                <br>
                <label for = "forumTitle">Title:</label>
                <input type="text" class="form-control" id="forumTitle" wire:model="forumTitle" required>
                <br>
                <select name="forumCategory" class="box" wire:model = "forumCategory" required>
                    <option value="" selected disabled>Category</option>
                    <option value="General Discussion">General Discussion</option>
                    <option value="Help">Help</option>
                    <option value="Blog">Blog</option>
                </select>
                <br>

                <label for ="forumBody">Body</label>
                <br>
                {{-- <textarea class="form-control" id="forumBody" wire:model="forumBody"
                style = "resize: none;">
            </textarea> --}}
                <input type="text" class="form-control" id="forumBody" wire:model="forumBody" required>
            </div>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
@elseif (auth()->user()->user_type == 'alumni')
    <section class="add-products">

        <div class="header-content post-container">
            <a href = "{{ url('forums') }}" class="back-home">Back To Forum</a>
            <div class="container1">

                <form id="survey-form" wire:submit.prevent="editForumPost" action="" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex">
                        <div class="inputBox">
                            {{-- <label for = "forumTitle">Title:</label> --}}
                            <input type="text" name="name" placeholder = "Title" class="box" id="forumTitle"
                                wire:model="forumTitle" required>

                            <select name="forumCategory" class="box" wire:model = "forumCategory" required>
                                <option value="" selected disabled>Category</option>
                                <option value="General Discussion">General Discussion</option>
                                <option value="Help">Help</option>
                                <option value="Blog">Blog</option>
                            </select>

                        </div>
                    </div>
                    <textarea name="forumBody" class="box" required placeholder = "Body" cols="30" rows="10"
                        wire:model = "forumBody"></textarea>
                    <input type="submit" value = "Post" class="btn">
                </form>
            </div>
    </section>
@endif
