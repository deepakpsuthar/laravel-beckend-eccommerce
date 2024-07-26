<x-admin.layout.master page-title="Roles And Permission">
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
                    <h1 class="h3 mb-0 text-gray-800">{{__('Roles & Permissions')}}</h1>
                    <div class="actions">
                        <a href="{{route('admin.roles.create')}}" class="btn btn-primary">{{__('Add')}}</a>
                    </div>
                </div>
                <div class="row">
                    @if ($roles)
                        @foreach ($roles as $role)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-white d-flex justify-content-between">
                                       <h3> {{ucwords($role->name)}}</h3>
                                        <a  href="{{route('admin.roles.edit',$role)}}"  class="btn btn-primary">{{__('Edit')}}</a>
                                    </div>
                                    <div class="card-body">
                                        <p>{{__('Role Permissions')}} <button class="btn btn-link">{{__('view')}}</button></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
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
