<x-admin-layout>
    <h2>Events</h2>
    <div>
        <a href="/admin/add-events"><button class="btn btn-primary mb-3">Add Events</button></a>
    </div>
    <div>
        <table id="example" class="table table-light table-striped table-hover rounded shadow-sm" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Action</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Event start</th>
                    <th>Event end</th>
                    <th>Updated by</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th>{{ $event->id }}</th>
                        {{-- separate row --}}
                        <td>
                            <div class="d-flex flex-column">
                                <!-- First Row - Edit Button -->
                                <a href="/admin/edit-events/{{ $event->id }}/{{ $event->title }}" class="flex-fill">
                                    <button class="btn btn-success me-1 w-100 h-100">View</button>
                                </a>

                                <!-- Second Row - Delete Button -->
                                <form action="/admin/delete-events/{{ $event->id }}" method="post"
                                    class="deleteEvents">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                                </form>
                            </div>
                        </td>

                        <td><img src="{{ $event->thumbnail }}" alt="{{ $event->title }}'s thumbnail"
                                style="width: 40px; margin: 10px;"></td>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y g:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y g:i A') }}</td>
                        <td>{{ $event->updatedBy->username }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->created_at)->format('F j, Y g:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->updated_at)->format('F j, Y g:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
