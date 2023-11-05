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
@if (auth()->user()->user_type != 'alumni')
    <div class = "container5">
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
            <a href="{{ url('forums') }}"><button class="cta" style="display: flex; align-items:center; position: relative;
                max-width: 1200px;">
                <span class="span">Back to Forums</span>
                <span class="second">
                    <svg width="50px" height="20px" viewBox="0 0 66 43" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                            <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                            <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                    </svg>
                </span>
            </button></a>
            <div class="container1">

                <form id="survey-form" wire:submit.prevent="createForumPost" action="" method="POST"
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
