
<x-admin.layout.master page-title="Roles & Permissions">
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
                </div>
                <form action="{{route('admin.roles.store')}}" method="POST" class="role-form" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">{{__('Add Role & Permission')}}</div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" name="name" placeholder="Enter Role Name" class="form-control @error('name') is-invalid  @enderror" value="{{old('name')}}" required>
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">{{__('Permissions')}}</div>
                        <div class="card-body permissions">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if ($permissions)
                                        @foreach ($permissions as $key => $permission)
                                            <div class="row mb-3">
                                                <div class="col-sm-12">
                                                    <h4>{{ucwords($key)}}</h4>
                                                    <div class="row ml-3">
                                                        @foreach ( $permission as $raw)
                                                            <div class="col-sm-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="perm_{{$raw->id}}" name="permissions[]" value="{{$raw->name}}" >
                                                                    <label class="form-check-label" for="perm_{{$raw->id}}">{{$raw->name}}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group d-flex justify-content-between">
                                        <a href="{{route('admin.roles.index')}}" class="btn btn-danger">{{__('Cancel')}}</a>
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout.master>
