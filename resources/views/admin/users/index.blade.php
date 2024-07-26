<x-admin.layout.master page-title="Users">
     <!-- ========== Left Sidebar Start ========== -->
   <x-admin.layout.sidebar />
   <!-- Left Sidebar End -->
   <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <x-admin.layout.header />
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{__('Users')}}</h1>
                    <div class="actions">
                        <a href="{{route('admin.users.create')}}" class="btn btn-primary">{{__('Add')}}</a>
                        <button type="button" id="bulkdltbtn" data-url="{{ route('admin.users.bulkdelete') }}" class="btn btn-danger">{{__('Bulk Delete')}}</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white">{{__('Manage Users')}}</div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    {!! $dataTable->scripts() !!}

        <script>
            const deleteHandler = (id) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Are you sure you want to delete this user?",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.users.destroy', '/id') }}";
                        url = url.replace('/id', id);
                        fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json; charset=UTF-8',
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                            })
                            .then(response => {
                                return response.json();
                            })
                            .then(data => {
                                if (data.status === "true") {
                                    oTable.draw(false);
                                    showToastr('success', 'Success', data.message);
                                }
                            });
                    }
                });
            }

        </script>
    @endpush

</x-admin.layout.master>
