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
                                                            <a href="{{ route('admin/view_survey', ['survey_selected' => $survey_posted->id]) }}"
                                                                class="flex-fill">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-icon-text"
                                                                    style="width: 150px; height: 50px; margin: 5px; ">
                                                                    <i class="ti-eye btn-icon-prepend"></i>
                                                                    View Answers
                                                                </button>
                                                            </a>
                                                            <br>
                                                            <a href="{{ route('edit_survey', ['survey_selected' => $survey_posted->id]) }}"
                                                                class="flex-fill">
                                                                <button type="button"
                                                                    class="btn btn-success btn-icon-text"
                                                                    style="width: 150px; height: 50px; margin: 5px; ">
                                                                    <i class="ti-pencil btn-icon-prepend"></i>
                                                                    Edit
                                                                </button>
                                                            </a>
                                                            <br>
                                                            <button class="btn btn-danger btn-icon-text"
                                                                style="width: 150px; height: 50px; margin: 5px;"
                                                                onclick="confirmDeleteSurvey({{ json_encode($survey_posted) }})">
                                                                <i class="ti-trash btn-icon-prepend"></i>
                                                                Delete
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
                                                    <td>
                                                        @php
                                                            $author = $users->firstWhere('id', $survey_posted->surveyAuthor);
                                                        @endphp
                                                        @if (isset($author->first_name))
                                                            {{ $author->first_name }}
                                                        @endif
                                                        @if (isset($author->last_name) && $author->first_name != $author->last_name)
                                                            {{ $author->last_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $updateAuthor = $users->firstWhere('id', $survey_posted->surveyUpdateAuthor);
                                                        @endphp
                                                        @if (isset($updateAuthor->first_name))
                                                            {{ $updateAuthor->first_name }}
                                                        @endif
                                                        @if (isset($updateAuthor->last_name) && $updateAuthor->first_name != $updateAuthor->last_name)
                                                            {{ $updateAuthor->last_name }}
                                                        @endif
                                                    </td>
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
