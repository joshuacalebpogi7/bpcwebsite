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

                                                <th>Id</th>
                                                <th>Action</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Survey Type</th>
                                                <th>Posted By</th>
                                                <th>Updated By</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($survey_list as $survey_posted)
                                                <tr>
                                                    <td>{{ $survey_posted->id }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('edit_survey', ['survey_selected' => $survey_posted->id]) }}"
                                                                class="flex-fill">
                                                                <button class="btn btn-light me-1 p-1 border mb-1"
                                                                    style="width: 150px;">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">
                                                                        <img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                            class="mr-2" alt="Edit Icon">
                                                                        Edit
                                                                    </div>
                                                                </button>
                                                            </a>
                                                            <br>
                                                            <button class="btn btn-light mt-1 p-1 border"
                                                                style="width: 150px;"
                                                                onclick="confirmDeleteSurvey({{ json_encode($survey_posted) }})">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                        class="mr-2" alt="Delete Icon">Delete
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>{{ $survey_posted->surveyTitle }}</td>
                                                    <td>{{ $survey_posted->surveyDesc }}</td>
                                                    @if ($survey_posted->surveyType === 'built_in')
                                                        <td>Built-in</td>
                                                    @endif
                                                    @if ($survey_posted->surveyType === 'google_forms')
                                                        <td>Google Forms</td>
                                                    @endif
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $survey_posted->created_at }}</td>
                                                    <td>{{ $survey_posted->updated_at }}</td>

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
