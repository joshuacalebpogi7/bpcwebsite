<!-- resources/views/livewire/survey-list.blade.php -->

<script>
    function confirmDeleteSurvey(surveyData) {
        if (confirm('Are you sure you want to delete "' + surveyData.surveyTitle + '"?')) {
            // If the user confirms, redirect to the delete route
            window.location.href = "/delete_survey/" + surveyData.id;
        }
    }
</script>



<div class="card">
    <div class="header2">
        <div class="content">
            <span class="title">Bulacan Polytechnic College Questionnaires</span>
            <hr class="solid" style="border-top: 3px solid #9f9d9d">
            @if (!$survey_list->isEmpty())
                @php
                    $allSurveysInactive = true;
                @endphp

                @foreach ($survey_list as $survey_posted)
                    @if ($survey_posted['active'] > 0)
                        @php
                            $allSurveysInactive = false;
                        @endphp
                        @if ($user->survey_completed == true)
                            @if ($survey_posted['forFirstTimers'] == false)
                                <div class="card_notification">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Survey #{{ $survey_posted->id }}:
                                            {{ $survey_posted->surveyTitle }}</div>

                                        <div class="notibody">{{ $survey_posted->surveyDesc }}</div>
                                        <a class="start_survey"
                                            href="{{ route('answer_survey', ['survey_selected' => $survey_posted->id]) }}">START</a>
                                    </div>
                                </div>
                            @endif
                        @elseif ($user->survey_completed == false)
                            @if ($survey_posted['forFirstTimers'] == true)
                            <p class="message">Before you can continue, we need your participation in the following surveys</p>
                                <div class="card_notification">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Survey #{{ $survey_posted->id }}:
                                            {{ $survey_posted->surveyTitle }}</div>

                                        <div class="notibody">{{ $survey_posted->surveyDesc }}</div>
                                        <a class="start_survey"
                                            href="{{ route('answer_survey', ['survey_selected' => $survey_posted->id]) }}">START</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach

                @if ($allSurveysInactive)
                    <p>No surveys available.</p>
                @endif
            @else
                <p>No surveys available.</p>
            @endif

        </div>
    </div>
</div>
