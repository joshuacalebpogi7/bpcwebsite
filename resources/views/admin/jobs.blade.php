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
                                                            <button type="button" class="btn btn-success btn-icon-text" style="width: 150px; height: 50px; margin: 5px; ">
                                                                <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                                                Edit
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-jobs/{{ $job->id }}"
                                                            method="post" class="deleteJobs">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-icon-text" style="width: 150px; height: 50px; margin: 5px;">
                                                                <i class="ti-trash btn-icon-prepend"></i>                                                    
                                                                Delete
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
                                                <td>{{ $job->updatedBy?->username }}</td>
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
