<x-admin-layout>
    <h2>Course List</h2>
    <div>
        <a href="/admin/add-courses"><button class="btn btn-primary mb-3">Add Courses</button></a>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Courses Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="coursetable" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Course Abbreviation</th>
                                            <th>Full Course Name</th>
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
                                                                class="btn btn-success me-1 w-100 h-100">View</button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-course/{{ $course->course }}"
                                                            method="post" class="deleteUser">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $course->course }}</td>
                                                <td>{{ $course->description }}</td>
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
