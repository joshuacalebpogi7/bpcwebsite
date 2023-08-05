<x-admin-layout>
    <h2>Surveys</h2>
    <div>
        <a href="/admin/add-survey"><button>Add Survey</button></a>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Submitted by</th>
                    <th>Course</th>
                    <th>Submitted at</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($surveys as $survey)
                    <tr>
                        <td>{{ $survey->thumbnail }}</td>
                        <td>{{ $survey->title }}</td>
                        <td>{{ $survey->description }}</td>
                        <td>{{ $survey->user->name }}</td>
                        <td>{{ $survey->course->name }}</td>
                        <td>{{ $survey->created_at }}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

</x-admin-layout>
