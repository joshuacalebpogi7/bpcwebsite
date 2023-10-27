<!-- resources/views/livewire/edit-survey/edit-survey.blade.php -->

<div class="container">
    <a href="{{ url('posted_surveys') }}"><button type = "button" class = "go-back-link">Go back</button></a>
    <header class="header">
        <h1 id="title" class="text-center">Edit "{{ $survey_selected->surveyTitle }}"</h1>
    </header>
    @if ($surveyType === 'built_in')
        <div class="BuiltIn">
            <form id="survey-form" wire:submit.prevent="updateBuiltIn">
                @csrf
                <div class="form-group">
                    <label id="name-label">
                        <input class="input-checkbox" type="checkbox" id="active" wire:model="active">
                        Active
                    </label>
                    <label id="name-label" for="surveyTitle">Survey Title</label>
                    <input type="text" class="form-control" id="surveyTitle" wire:model="surveyTitle" required>

                    <label id="name-label" for="surveyDesc">Survey Description</label>
                    <input type="text" class="form-control" id="surveyDesc" wire:model="surveyDesc">
                </div>

                <div class = "form-group">
                    <hr class="solid" style="border: 1.5px solid #9f9d9d">
                </div>

                @foreach ($questions as $questionIndex => $question)
                    <div class="form-group" wire:key="question-{{ $questionIndex }}">
                        <input type="hidden" name="question_num" class="form-control"
                            id="question_num_{{ $questionIndex }}"
                            wire:model="questions.{{ $questionIndex }}.questionNum">

                        <label for="choiceType_for_question_{{ $questionIndex }}">Type:</label>
                        <select class="form-control" name="question_type"
                            id="choiceType_for_question_{{ $questionIndex }}"
                            wire:model="questions.{{ $questionIndex }}.questionType">
                            <option value="text">[TEXT] User Input</option>
                            <option value="radio">[RADIO] Multiple Choice</option>
                            <option value="checkbox">[CHECKBOX] Checkbox</option>
                        </select>

                        <label for="question_{{ $questionIndex }}">Question {{ $questionIndex + 1 }}</label>

                        <input type="text" class="form-control" id="question_{{ $questionIndex }}"
                            wire:model="questions.{{ $questionIndex }}.questionDesc" required>


                        <div class="choices" id="choices_{{ $questionIndex }}">
                            @foreach ($question['choices'] as $choiceIndex => $choice)
                                {{-- @dump($choice) --}}
                                <div class="form-group" wire:key="choice-{{ $questionIndex }}-{{ $choiceIndex }}">

                                    <label for="choice_{{ $questionIndex }}_{{ $choiceIndex }}">Choice
                                        {{ $choiceIndex + 1 }}:</label>
                                    <input class="form-control input_choice" type="text" name="choiceDesc"
                                        placeholder="Choice {{ $choiceIndex + 1 }}"
                                        wire:model="questions.{{ $questionIndex }}.choices.{{ $choiceIndex }}.choiceDesc">
                                </div>
                            @endforeach
                        </div>
                        <div class = "form-group">
                            <hr class="solid" style="border: 1.5px solid #9f9d9d">
                        </div>
                @endforeach

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
