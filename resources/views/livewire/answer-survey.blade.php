<div class = "container">
    <a href="{{ url('survey') }}"><button type = "button" class = "go-back-link">Go back</button></a>
    <header class="header">
        <div>
            <hr>
            <h1 id="title" class="text-center">{{-- Survey Title:  --}}{{ $survey_selected->surveyTitle }}</h1>
            <br>
            <p id="description" class="description text-center">{{-- Survey Description: --}}
                {{ $survey_selected->surveyDesc }}</p>
        </div>
    </header>
    @if ($surveyType === 'built_in')
        <div class = "BuiltIn">
            @if ($user->survey_completed > 0)
                <form id="survey-form" wire:submit.prevent="answerBuiltIn">
                @elseif ($user->survey_completed <= 0)
                    <form id="survey-form" wire:submit.prevent="answerBuiltInInitial">
            @endif
            @csrf
            @foreach ($questions as $questionIndex => $question)
            @dump($question)
                <div class="form-group" wire:key="question-{{ $questionIndex }}">
                    <hr>
                    <label id="name-label">{{ $question['questionNum'] }}:
                        {{ $question['questionDesc'] }}</label>
                    @if ($question['questionType'] == 'dropdown')
                        <label>
                            <select id="question-{{ $questionIndex }}" class="input-select"
                                name="questions.{{ $questionIndex }}.answers.select.choiceID"
                                wire:model="questions.{{ $questionIndex }}.answers.select.choiceID" required>
                                <option value = "" selected>Select an option</option>
                                @foreach ($question['choices'] as $choiceIndex => $choice)
                                    <option value="{{ $choice['id'] }}">{{ $choice['choiceDesc'] }}</option>
                                @endforeach
                            </select>
                        </label>
                    @endif
                    <div class="choices" id="choices_{{ $questionIndex }}">
                        @foreach ($question['choices'] as $choiceIndex => $choice)
                            <div class="form-group"
                                wire:key="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}">
                                @if ($question['questionType'] == 'radio')
                                    <label>
                                        <input type="{{ $question['questionType'] }}"
                                            id="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                            value="{{ $choice['id'] }}" class="input-radio"
                                            name = "questions.{{ $questionIndex }}.answers.radio.choiceID"
                                            wire:model = "questions.{{ $questionIndex }}.answers.radio.choiceID"
                                            required>
                                        {{ $choice['choiceDesc'] }}
                                    </label>
                                @elseif ($question['questionType'] == 'checkbox')
                                    <label>
                                        <input type="{{ $question['questionType'] }}"
                                            id="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                            value="{{ $choice['id'] }}" class="input-checkbox"
                                            name = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.choiceID[]"
                                            wire:model = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.choiceID"
                                            required>
                                        {{ $choice['choiceDesc'] }}
                                    </label>
                                @elseif($question['questionType'] == 'text')
                                    <input type = "{{ $question['questionType'] }}"
                                        id = "question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                        placeholder = "{{ $choice['choiceDesc'] }}" class="form-control"
                                        name = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.answerDesc[]"
                                        wire:model = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.answerDesc"
                                        required>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <hr>
                </div>
            @endforeach

            <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    @elseif ($surveyType === 'google_forms')
        <div class="GoogleForms">
            @if ($user->survey_completed > 0)
                <form id="survey-form" wire:submit.prevent="answerGoogleForms">
                @elseif ($user->survey_completed <= 0)
                    <form id="survey-form" wire:submit.prevent="answerGoogleFormsInitial">
            @endif
            @csrf
            <div class="form-group">
                <hr>
                <label for="surveyTitle">Finished Answering:</label>
                <input type="checkbox" class="form-control" id="surveyTitle" wire:model="answerDesc"
                    wire:model="answerDesc" required>
            </div>
            <hr>
            <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    @endif
</div>
