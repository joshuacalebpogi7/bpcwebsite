{{-- <div class="container"> --}}
    {{-- <a href="{{ url('admin/surveys') }}"><button type = "button" class = "go-back-link">Go back</button></a> --}}
    {{-- <header class="header">
        <h1 id="title" class="text-center">Create New Questionnaire</h1> --}}
        {{-- <label id="name-label">Survey Type</label>
         <select class="form-control" wire:model="surveyType">
            <option disabled selected value="">Choose type</option>
            <option value="Built_in">Built-in</option>
            <option value="Google_form">Google Forms</option>
        </select> --}}
    {{-- </header>
    <div> --}}
        {{-- @if ($surveyType === 'Built_in') --}}
        {{-- <form id="survey-form" wire:submit.prevent="saveBuiltIn">
            @csrf
            <div class="form-group">
                <label>
                    <input type="checkbox" class="input-checkbox" id="active" wire:model="active">
                    Enabled</label>
                <br>
                <label>
                    <input type="checkbox" class="input-checkbox" id="forFirstTimers" wire:model="forFirstTimers">
                    For first time users</label>
                <hr>
                <label for="surveyTitle">Title:</label>
                <input type="text" class="form-control" id="surveyTitle" autocomplete="off" wire:model="surveyTitle"
                    required>

                <label for="surveyDesc">Description:</label>
                <input type="text" class="form-control" id="surveyDesc" autocomplete="off" wire:model="surveyDesc">

            </div>
            <div class = "form-group">
                <hr class="solid" style="border: 1.5px solid #9f9d9d">
            </div> --}}

            {{-- @foreach ($questions as $questionIndex => $question)
                <div class="form-group" wire:key="question-{{ $questionIndex }}">
                    @if ($questionIndex > 0)
                        <div class = "form-group">
                            <button wire:click.prevent="removeQuestion({{ $questionIndex }})"
                                class="submit-button delete-question"><img
                                    src="{{ URL::asset('/images/icon-delete.svg') }}">
                                {{ $questionIndex + 1 }}</button>
                        </div>
                    @endif --}}

                    {{-- <label for="choiceType_for_question_{{ $questionIndex }}">  --}}
                        {{-- Question {{ $questionIndex + 1 }} --}}
                        {{-- Type Selected:&nbsp;<span
                            style="text-transform: capitalize; display: inline-block;">{{ $question['questionType'] }}</span>
                    </label>
                    <select class="form-control" name="question_type" id="choiceType_for_question_{{ $questionIndex }}"
                        wire:model="questions.{{ $questionIndex }}.questionType">
                        <option value="text">&#128292; Textbox</option>
                        <option value="radio">&#128280; Multiple Choice</option>
                        <option value="checkbox">[&#10003;] Checkbox</option>
                        <option value="dropdown">[&#9660;] Dropdown</option>
                    </select>

                    <label for="question_{{ $questionIndex }}">Question {{ $questionIndex + 1 }}:</label>
                    <input type="hidden" name="question_num_{{ $questionIndex }}" class="form-control"
                        id="question_num_{{ $questionIndex }}"
                        wire:model="questions.{{ $questionIndex + 1 }}.questionNum">
                    <input type="text" name="question_desc" class="form-control" id="question_{{ $questionIndex }}"
                        autocomplete="off" placeholder="Question {{ $questionIndex + 1 }}"
                        wire:model="questions.{{ $questionIndex }}.questionDesc" required> --}}

                    {{-- @if ($questions[$questionIndex]['questionType'] != 'text') --}}
                    {{-- @endif --}}
                    {{-- <div class="choices" id="choices_{{ $questionIndex }}">
                        @foreach ($question['choices'] as $choiceIndex => $choice)
                            <div class="form-group" wire:key="choice-{{ $questionIndex }}-{{ $choiceIndex }}">

                                <label for="choice_{{ $questionIndex }}_{{ $choiceIndex }}">Choice
                                    {{ $choiceIndex + 1 }}:
                                </label>

                                <input type="hidden" name="choice_num_{{ $questionIndex }}_{{ $choiceIndex }}"
                                    class="form-control" id="choice_num_{{ $choiceIndex }}"
                                    wire:model="questions.{{ $questionIndex }}.choices.{{ $choiceIndex }}.choiceNum">
                                @if ($choiceIndex > 0)
                                    <button
                                        wire:click.prevent="removeChoice({{ $questionIndex }}, {{ $choiceIndex }})"
                                        class="submit-button delete-choice"><img
                                            src="{{ URL::asset('/images/icon-delete.svg') }}">
                                    </button>
                                @endif
                                <input class = "form-control input_choice" type="text" name="choiceDesc"
                                    autocomplete="off" placeholder="Choice {{ $choiceIndex + 1 }}"
                                    wire:model="questions.{{ $questionIndex }}.choices.{{ $choiceIndex }}.choiceDesc">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button class = "submit-button add choice"
                            wire:click.prevent="addChoice({{ $questionIndex }})">
                            &#43; Choice</button>
                        <br>
                    </div>
                </div>
                <div class = "form-group">
                    <hr class="solid" style="border: 1.5px solid #9f9d9d">
                </div>
            @endforeach
            <div class="form-group">
                <button class = "submit-button add question" wire:click.prevent="addQuestion"
                    class="btn btn-primary">&#43;
                    Question</button>
            </div>


            <button type="submit" class="submit-button">Submit</button>
        </form> --}}

        {{-- @endif --}}
        {{--         @if ($surveyType === 'Google_form')
            <form id = "survey-form" wire:submit.prevent="saveGForm">
                @csrf
                <div class="form-group">
                    <hr>
                <label>
                    <input type="checkbox" class="input-checkbox" id="active" wire:model="active">
                    Enabled</label>
                                        <label>
                    <input type="checkbox" class="input-checkbox" id="initial" wire:model="forFirstTimers">
                    For first time users</label>
                <label for="surveyTitle">Title:</label>
                <input type="text" class="form-control" id="surveyTitle" wire:model="surveyTitle" required>

                <label for="surveyDesc">Description:</label>
                <input type="text" class="form-control" id="surveyDesc" wire:model="surveyDesc">

                    <label for="surveyLink">Survey Link:</label>
                    <input type="text" class="form-control" id="surveyLink" wire:model="surveyLink">

                    <label for="surveyEditorLink">Survey Editor Link:</label>
                    <input type="text" class="form-control" id="surveyEditorLink" wire:model="surveyEditorLink">
                </div>

                <button type="submit" class="submit-button">Submit</button>
            </form>
        @endif --}}
    {{-- </div>

</div> --}}

<div class="col-12 grid-margin stretch-card" style="margin-top: 10px">
    <div class="card">
      <div class="card-body">
        <h1 class="text-center">Create New Questionnaire</h1>

        <form id="survey-form" wire:submit.prevent="saveBuiltIn" class="forms-sample">
            @csrf
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="active" wire:model="active" checked>
                        Enabled
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="forFirstTimers" wire:model="forFirstTimers">
                        For first time users
                    </label>
                </div>

            <label for="surveyTitle">Title:</label>
            <input type="text" class="form-control" id="surveyTitle" autocomplete="off" wire:model="surveyTitle"
            placeholder="Title" required>

            <label for="surveyDesc">Description:</label>
            <input type="text" class="form-control" id="surveyDesc" autocomplete="off" wire:model="surveyDesc">
          </div>

        <div class="form-group">
            <hr class="solid" style="border: 1.5px solid #110202">
        </div>
        
        @foreach ($questions as $questionIndex => $question)
                <div class="form-group" wire:key="question-{{ $questionIndex }}">
                    @if ($questionIndex > 0)
                        <div class = "form-group">
                            <button type="button" wire:click.prevent="removeQuestion({{ $questionIndex }})"
                                class="btn btn-danger btn-icon-text">
                                <i class="ti-trash btn-icon-prepend"></i>                                                    
                                Delete
                          </button>
                        </div>
                    @endif

                    <label for="choiceType_for_question_{{ $questionIndex }}">{{-- Question {{ $questionIndex + 1 }} --}}
                        Type Selected:&nbsp;<span
                            style="text-transform: capitalize; display: inline-block;">{{ $question['questionType'] }}</span>
                    </label>
                    <select class="form-control" name="question_type" id="choiceType_for_question_{{ $questionIndex }}"
                        wire:model="questions.{{ $questionIndex }}.questionType">
                        <option value="text">&#128292; Textbox</option>
                        <option value="radio">&#128280; Multiple Choice</option>
                        <option value="checkbox">[&#10003;] Checkbox</option>
                        <option value="dropdown">[&#9660;] Dropdown</option>
                    </select>

                    <label for="question_{{ $questionIndex }}">Question {{ $questionIndex + 1 }}:</label>
                    <input type="hidden" name="question_num_{{ $questionIndex }}" class="form-control"
                        id="question_num_{{ $questionIndex }}"
                        wire:model="questions.{{ $questionIndex + 1 }}.questionNum">
                    <input type="text" name="question_desc" class="form-control" id="question_{{ $questionIndex }}"
                        autocomplete="off" placeholder="Question {{ $questionIndex + 1 }}"
                        wire:model="questions.{{ $questionIndex }}.questionDesc" required>

                    {{-- @if ($questions[$questionIndex]['questionType'] != 'text') --}}
                    {{-- @endif --}}
                    <div class="choices" id="choices_{{ $questionIndex }}">
                        @foreach ($question['choices'] as $choiceIndex => $choice)
                            <div class="form-group" wire:key="choice-{{ $questionIndex }}-{{ $choiceIndex }}">

                                <label for="choice_{{ $questionIndex }}_{{ $choiceIndex }}">Choice
                                    {{ $choiceIndex + 1 }}:
                                </label>

                                <input type="hidden" name="choice_num_{{ $questionIndex }}_{{ $choiceIndex }}"
                                    class="form-control" id="choice_num_{{ $choiceIndex }}"
                                    wire:model="questions.{{ $questionIndex }}.choices.{{ $choiceIndex }}.choiceNum">
                                @if ($choiceIndex > 0)
                                    <button type="button" style="margin: -5px 5px 5px 5px;"
                                        wire:click.prevent="removeChoice({{ $questionIndex }}, {{ $choiceIndex }})"
                                        class="btn btn-danger btn-icon-text btn-sm">
                                        <i class="ti-trash btn-icon-prepend"></i>                                                    
                                        Delete
                                    </button>
                                @endif
                                <input class = "form-control input_choice" type="text" name="choiceDesc"
                                    autocomplete="off" placeholder="Choice {{ $choiceIndex + 1 }}"
                                    wire:model="questions.{{ $questionIndex }}.choices.{{ $choiceIndex }}.choiceDesc">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info mr-2"
                            wire:click.prevent="addChoice({{ $questionIndex }})">
                            &#43; Choice</button>
                        <br>
                    </div>
                </div>
                <div class = "form-group">
                    <hr class="solid" style="border: 1.5px solid #9f9d9d">
                </div>
            @endforeach
            <div class="form-group">
                <button type="button" wire:click.prevent="addQuestion" class="btn btn-warning">&#43;
                    Question</button>
            </div>

          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>