<x-admin-layout>
    <h2>Events Records</h2>
    <div>
        <a href="/admin/add-events"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Events</button></a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Events Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
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
                                                        <a href="/admin/edit-events/{{ $event->id }}/{{ $event->title }}"
                                                            class="flex-fill">
                                                            <button
                                                                class="btn btn-light me-1 w-100 h-100 p-1 border mb-1">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                        class="mr-2" alt="Edit Icon">
                                                                    Edit
                                                                </div>
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-events/{{ $event->id }}"
                                                            method="post" class="deleteEvents">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-light mt-1 flex-fill w-100 h-100 p-1 border">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                        class="mr-2" alt="Delete Icon">Delete
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td><img src="{{ $event->thumbnail }}"
                                                        alt="{{ $event->title }}'s thumbnail"
                                                        style="width: 40px; margin: 10px;"></td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y g:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y g:i A') }}
                                                </td>
                                                <td>{{ $event->updatedBy->username }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->created_at)->format('F j, Y g:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($event->updated_at)->format('F j, Y g:i A') }}
                                                </td>
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
