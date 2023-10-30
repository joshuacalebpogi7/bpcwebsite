<x-admin-layout>
    <h2>Jobs Records</h2>
    <div>
        <a href="/admin/add-jobs"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add
                Jobs</button></a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Jobs Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Job Title</th>
                                            <th>Job Type</th>
                                            <th>Company</th>
                                            <th>Salary</th>
                                            <th>Status</th>
                                            <th>Posted by</th>
                                            <th>Updated by</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <th>{{ $job->id }}</th>
                                                {{-- separate row --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <!-- First Row - Edit Button -->
                                                        <a href="/admin/edit-jobs/{{ $job->id }}/{{ $job->job_title }}"
                                                            class="flex-fill">
                                                            <button
                                                                class="btn btn-light me-1 w-100 h-100 p-1 border mb-1"
                                                                style="width: 150px;">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                        class="mr-2" alt="Edit Icon">
                                                                    Edit
                                                                </div>
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-jobs/{{ $job->id }}"
                                                            method="post" class="deleteJobs">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-light mt-1 flex-fill w-100 h-100 p-1 border"
                                                                style="width: 150px;">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                        class="mr-2" alt="Delete Icon">Delete
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td>{{ $job->job_title }}</td>
                                                <td>{{ $job->job_type }}</td>
                                                <td>{{ $job->company }}</td>
                                                <td>{{ $job->salary }}</td>
                                                <td>{{ $job->status }}</td>
                                                <td>{{ $job->posted_by }}</td>
                                                <td>{{ $job->updatedBy->username }}</td>
                                                <td>{{ $job->created_at }}</td>
                                                <td>{{ $job->updated_at }}</td>

                                            </tr>
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

</x-admin-layout>
