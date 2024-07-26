
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
                    <h1 class="h3 mb-0 text-gray-800">Users</h1>
                </div>
                <div class="card">
                    <div class="card-header">Add User</div>
                    <div class="card-body">
                        <form action="{{route('admin.users.store')}}" method="POST" class="user-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                       <div class="profile-img">
                                        <img class="img-profile rounded-circle" id="img_uploader" src="{{asset('assets/img/undraw_profile.svg')}}">
                                       </div>
                                        <input type="file" name="profile_img" id="image" class="d-none">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" name="name" placeholder="Enter Your Name" class="form-control @error('name') is-invalid  @enderror" value="{{old('name')}}" required>
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="email" name="email" placeholder="Enter Your Email" class="form-control @error('email') is-invalid  @enderror" value="{{old('email')}}" required>
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{__('Role')}}</label>
                                       <select name="role" id="role" class="form-control">
                                            @foreach ($roles as $key=>$val)
                                                <option value="{{$val['name']}}" {{$val['name'] =='client' ?'selected' : ''}}>{{$val['name']}}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{__('Password')}}</label>
                                        <input type="password" name="password" placeholder="Enter password" class="form-control @error('password') is-invalid  @enderror" required>
                                        @error('password')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <a href="{{route('admin.users.index')}}" class="btn btn-danger">{{__('Cancel')}}</a>
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </div>
                                </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout.master>
