<x-admin-layout>
    @push('scripts')
    <script>
        function confirmDeleteSurvey(surveyData) {
            if (confirm('Are you sure you want to delete "' + surveyData.surveyTitle + '"?')) {
                // If the user confirms, redirect to the delete route
                window.location.href = "/delete_survey/" + surveyData.id;
            }
        }
    </script>
    @endpush
    <h2>Survey Records</h2>
    <div>
        <a href="{{ url('admin/new_survey') }}"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Survey</button></a>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Survey Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                            @if (!$survey_list->isEmpty())
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Survey Type</th>
                                                        <th>Date Created</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                
                                    <tbody>
                                        @foreach ($survey_list as $survey_posted)
                                        
                                            <tr>
                                                <td>{{ $survey_posted->id }}</td>
                                                <td>

                                                    <a
                                                        href="{{ route('edit_survey', ['survey_selected' => $survey_posted->id]) }}">
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
                                                                <img
                                                                    src="{{ URL::asset('/images/icon-edit.svg') }}"></button></a>
                                                        <br>
                                                        <button class = "survey_action"
                                                            onclick="confirmDeleteSurvey({{ json_encode($survey_posted) }})"><img
                                                                src="{{ URL::asset('/images/icon-delete.svg') }}"></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
