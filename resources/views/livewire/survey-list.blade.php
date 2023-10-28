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
            @if (auth()->user()->user_type === 'alumni')
                @if (!$survey_list->isEmpty())
                    <p class="message">Before you continue, we need your participation in the following surveys</p>
                    @php
                        $allSurveysInactive = true;
                    @endphp

                    @foreach ($survey_list as $survey_posted)
                        @if ($survey_posted['active'] > 0)
                            @php
                                $allSurveysInactive = false;
                            @endphp

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
                    @endforeach

                    @if ($allSurveysInactive)
                        <p>No surveys available.</p>
                    @endif
                @else
                    <p>No surveys available.</p>
                @endif
            @elseif (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'content creator')
                <div class="card_notification">
                    <div class="notiglow"></div>
                    <div class="notiborderglow"></div>
                    <table>
                        <tbody>
                            <div class="notititle">
                                <tr>
                                    <th colspan="7">
                                        <a class = "message" href="{{ url('new_survey') }}"><button
                                                class = "survey_action new_survey"><img
                                                    src="{{ URL::asset('/images/icon-plus.svg') }}"> New
                                                Survey</button></a>
                                    </th>
                                </tr>
                                @if (!$survey_list->isEmpty())
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Survey Type</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                            </div>
                            @foreach ($survey_list as $survey_posted)
                                <tr>
                                    <td>{{ $survey_posted->id }}</td>
                                    <td><img src="{{ URL::asset('/images/xls_icon.png') }}" height="25"
                                            width="25"></td>
                                    <td>

                                        <a
                                            href="{{ route('answer_survey', ['survey_selected' => $survey_posted->id]) }}">
                                            <button class = "survey_action">
                                                {{ $survey_posted->surveyTitle }}
                                            </button>
                                        </a>
                                    </td>
                                    <td>{{ $survey_posted->surveyDesc }}</td>
                                    @if ($survey_posted->surveyType === 'built_in')
                                        <td>Built-in</td>
                                    @endif
                                    @if ($survey_posted->surveyType === 'google_forms')
                                        <td>Google Forms</td>
                                    @endif
                                    <td>{{ $survey_posted->created_at }}</td>
                                    <td>
                                        <div>
                                            <a
                                                href="{{ route('edit_survey', ['survey_selected' => $survey_posted->id]) }}"><button
                                                    class = "survey_action">
                                                    <img src="{{ URL::asset('/images/icon-edit.svg') }}"></button></a>
                                            <br>
                                            <button class = "survey_action"
                                                onclick="confirmDeleteSurvey({{ json_encode($survey_posted) }})"><img
                                                    src="{{ URL::asset('/images/icon-delete.svg') }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <p>No surveys available.</p>
            @endif
            @endif
        </div>
    </div>
