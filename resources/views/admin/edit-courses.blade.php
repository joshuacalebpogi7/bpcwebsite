<x-admin-manage-layout>
    <div>
        <form action="/admin/update-courses/{{ $course->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Edit Course
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course">Course Abbreviation</label>
                                <input class="form-control @error('course') is-invalid @enderror" type="text"
                                    placeholder="Courses Abbreviation" name="course" id="course"
                                    value="{{ old('course', $course->course) }}">

                                @error('course')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Full Course Name</label>
                                <input class="form-control @error('description') is-invalid @enderror" type="text"
                                    placeholder="Full Course Name" name="description" id="description"
                                    value="{{ old('description', $course->description) }}">

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Update Event</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-manage-layout>
