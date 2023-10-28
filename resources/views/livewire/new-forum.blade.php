<div class = "container">
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

            <label for ="forumBody">Body</label>
            <br>
            <textarea rows="4" cols="50" class="form-control" id="forumBody" wire:model="forumBody"
                style = "resize: none;">
            </textarea>
        </div>

        <button type="submit" class="submit-button">Submit</button>
    </form>
</div>
