<x-admin-layout>
    <h2>Courses Records</h2>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="/admin/add-courses"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Courses</button></a>
        <form action="/import-courses" method="post" enctype="multipart/form-data">
            @csrf
            <div style="display: flex; align-items: center;">
                <input class="form-control @error('excel_file') is-invalid @enderror" name="excel_file" type="file">
                @error('excel_file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <button class="btn btn-primary">
                    Import</button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Courses Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="coursetable" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Course Abbreviation</th>
                                            <th>Full Course Name</th>
                                            <th>Employed</th>
                                            <th>Self-employed</th>
                                            <th>Unemployed</th>
                                            <th>Date added</th>
                                            <th>Date updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <th>{{ $course->id }}</th>
                                                {{-- separate row --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <!-- First Row - Edit Button -->
                                                        <a href="/admin/edit-courses/{{ $course->course }}"
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
                                                        <form action="/admin/delete-course/{{ $course->id }}"
                                                            method="post" class="deleteUser">
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
                                                <td>{{ $course->course }}</td>
                                                <td>{{ $course->description }}</td>
                                                <td>{{ $user->where('course', $course->course)->where('employment_status', 'employed')->count() }}
                                                </td>
                                                <td>{{ $user->where('course', $course->course)->where('employment_status', 'self-employed')->count() }}
                                                </td>
                                                <td>{{ $user->where('course', $course->course)->where('employment_status', 'unemployed')->count() }}
                                                </td>
                                                <td>{{ $course->created_at->format('M d, Y h:i A') }}</td>
                                                <td>{{ $course->updated_at->format('M d, Y h:i A') }}</td>
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
