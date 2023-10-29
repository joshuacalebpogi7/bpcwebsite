<!-- resources/views/livewire/edit-survey/edit-survey.blade.php -->

<div class="container">
    <a href="{{ url('admin/surveys') }}"><button type = "button" class = "go-back-link">Go back</button></a>
    <header class="header">
        <h1 id="title" class="text-center">Edit "{{ $survey_selected->surveyTitle }}"</h1>
    </header>
    @if ($surveyType === 'built_in')
        <div class="BuiltIn">
            <form id="survey-form" wire:submit.prevent="updateBuiltIn">
                @csrf
                <div class="form-group">
                    <label>
                        <input type="checkbox" class="input-checkbox" id="active" wire:model="active">
                        Enabled</label>
                    <label>
                        <input type="checkbox" class="input-checkbox" id="forFirstTimers" wire:model="forFirstTimers">
                        For first time users</label>
                    <hr>
                    <label for="surveyTitle">Title:</label>
                    <input type="text" class="form-control" id="surveyTitle" wire:model="surveyTitle" required>
    
                    <label for="surveyDesc">Description:</label>
                    <input type="text" class="form-control" id="surveyDesc" wire:model="surveyDesc">
    
                </div>
                <div class = "form-group">
                    <hr class="solid" style="border: 1.5px solid #9f9d9d">
                </div>
    
                @foreach ($questions as $questionIndex => $question)
                    <div class="form-group" wire:key="question-{{ $questionIndex }}">
                        @if ($questionIndex > 0)
                            <div class = "form-group">
                                <button wire:click.prevent="removeQuestion({{ $questionIndex }})"
                                    class="submit-button delete-question"><img
                                        src="{{ URL::asset('/images/icon-delete.svg') }}">
                                    {{ $questionIndex + 1 }}</button>
                            </div>
                        @endif
    
                        <label for="choiceType_for_question_{{ $questionIndex }}">{{-- Question {{ $questionIndex + 1 }} --}}
                            Type Selected:&nbsp;<span
                                style="text-transform: capitalize; display: inline-block;">{{ $question['questionType'] }}</span>
                        </label>
                        <select class="form-control" name="question_type" id="choiceType_for_question_{{ $questionIndex }}"
                            wire:model="questions.{{ $questionIndex }}.questionType">
                            <option value="text">&#128292; User Input</option>
                            <option value="radio">&#128280; Multiple Choice</option>
                            <option value="checkbox">[&#10003;] Checkbox</option>
                            <option value="dropdown">[&#9660;] Dropdown</option>
                        </select>
    
                        <label for="question_{{ $questionIndex }}">Question {{ $questionIndex + 1 }}:</label>
                        <input type="hidden" name="question_num_{{ $questionIndex }}" class="form-control"
                            id="question_num_{{ $questionIndex }}"
                            wire:model="questions.{{ $questionIndex + 1 }}.questionNum">
                        <input type="text" name="question_desc" class="form-control" id="question_{{ $questionIndex }}"
                            placeholder="Question {{ $questionIndex + 1 }}"
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
                                        <button
                                            wire:click.prevent="removeChoice({{ $questionIndex }}, {{ $choiceIndex }})"
                                            class="submit-button delete-choice"><img
                                                src="{{ URL::asset('/images/icon-delete.svg') }}">
                                        </button>
                                    @endif
                                    <input class = "form-control input_choice" type="text" name="choiceDesc"
                                        placeholder="Choice {{ $choiceIndex + 1 }}"
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
    
    
                <button type="submit" class="submit-button">Update</button>
            </form>

        </div>
    @elseif ($surveyType === 'google_forms')
        <div class="GoogleForms">
            <form id="survey-form" wire:submit.prevent="updateGoogleForms">
                @csrf
                <div class="form-group">
                    <hr>
                    <label>Survey Type: {{ $surveyType }}</label>
                    <label for="surveyTitle">Survey Title:</label>
                    <input type="text" class="form-control" id="surveyTitle" wire:model="surveyTitle" required>

                    <label for="surveyDesc">Survey Description:</label>
                    <input type="text" class="form-control" id="surveyDesc" wire:model="surveyDesc">

                    <label for="surveyLink">Survey Link:</label>
                    <input type="text" class="form-control" id="surveyLink" wire:model="surveyLink">

                    <label for="surveyEditorLink">Survey Editor Link:</label>
                    <input type="text" class="form-control" id="surveyEditorLink" wire:model="surveyEditorLink">

                    <label for="active">Active:</label>
                    <input type="checkbox" id="active" wire:model="active">
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    @endif
</div>
