<div class = "container">
    <header class="header">
        <h1 id="title" class="text-center">Create A Discussion</h1>
        {{-- <label id="name-label">Survey Type</label>
         <select class="form-control" wire:model="surveyType">
            <option disabled selected value="">Choose type</option>
            <option value="Built_in">Built-in</option>
            <option value="Google_form">Google Forms</option>
        </select> --}}
    </header>
    <form id="survey-form" wire:submit.prevent="createForumPost">
        @csrf
        <div class="form-group">
            <label>
                <input type="checkbox" class = "input-checkbox" id="active" wire:model="active">Active
            </label>
            <br>
            <label for = "forumTitle">Title:</label>
            <input type="text" class="form-control" id="forumTitle" wire:model="forumTitle" required>
            <br>
            <label for = "forumCategory">Category:</label>
            <input type="text" class="form-control" id="forumCategory" wire:model="forumCategory" required>
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
