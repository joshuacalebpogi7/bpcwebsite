<div>
    <h2>{{$survey_selected->surveyTitle}}</h2>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">{{$survey_selected->surveyDesc}}</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Respondent</th>

                                            @foreach ($survey_questions as $survey_question)
                                                <th>{{ $survey_question->questionDesc }}</th>
                                            @endforeach

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($survey_answers as $survey_answer)
                                            <td>{{ $survey_answer->respondentID }}</td>

                                            <td>{{ $survey_answer->answerDesc }}</td>
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
