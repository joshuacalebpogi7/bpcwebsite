<div>
    <form wire:submit.prevent="createForumPost">
        @csrf
        <div class="form-group">
            <label for="forumTitle">Title:</label>
            <input type="text" class="form-control" id="forumTitle" wire:model="forumTitle" required>

            <label for="active">Active:</label>
            <input type="checkbox" id="active" wire:model="active">
            <br>
            <label for ="forumBody">Body:</label>
<br>
            <textarea rows="4" cols="50" class="form-control" id="forumBody" wire:model="forumBody">
            </textarea>
        </div>

        <button type="submit" class="submit-button">Submit</button>
    </form>
</div>
