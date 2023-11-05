<div>
    @push('scripts')
        <script>
            function confirmDeleteAnswer(surveyAnswerData) {
                if (confirm('Are you sure you want to delete answer data from User ID: "' + surveyAnswerData.respondentID + '"?')) {
                    // If the user confirms, redirect to the delete route
                    window.location.href = "/delete_answer/" + surveyAnswerData.respondentID;
                }
            }
        </script>
    @endpush
    <br>
    <h2>{{ $survey_selected->surveyTitle }}</h2>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">{{ $survey_selected->surveyDesc }}</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            @php
                                                $displayedRespondent = false;
                                                $lastRespondentID = null;
                                            @endphp
                                            @foreach ($survey_questions as $survey_question)
                                                <th>{{ $survey_question->questionDesc }}</th>
                                            @endforeach
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($survey_answers as $survey_answer)
                                            @php
                                                $respondentInfo = $respondents->firstWhere('id', $survey_answer->respondentID);
                                            @endphp
                                            @if ($lastRespondentID !== $survey_answer->respondentID || !$displayedRespondent)
                                                <td>{{ $respondentInfo->username }}</td>
                                                <td>{{ $respondentInfo->first_name }}
                                                    @if ($respondentInfo->first_name != $respondentInfo->last_name)
                                                        {{ $respondentInfo->last_name }}
                                                    @endif
                                                </td>
                                                @php
                                                    $lastRespondentID = $survey_answer->respondentID;
                                                    $displayedRespondent = true;
                                                @endphp
                                            @endif
                                            <td>{{ $survey_answer->answerDesc }}</td>
                                            @if ($loop->last)
                                                <td>
                                                    <button class="btn btn-danger btn-icon-text"
                                                        style="width: 50px; height: 50px; margin: 5px;"
                                                        onclick="confirmDeleteAnswer({{ json_encode($survey_answer) }})">
                                                        <i class="ti-trash btn-icon-prepend"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
