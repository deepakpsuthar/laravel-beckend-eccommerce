
<x-admin.layout.master page-title="Category">
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
                    <h1 class="h3 mb-0 text-gray-800">{{__('Categories')}}</h1>
                </div>
                <div class="card">
                    <div class="card-header">{{__('Add Category')}}</div>
                    <div class="card-body">
                        <form action="{{route('admin.categories.store')}}" method="POST" class="category-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-left-img">
                                            <img class="rounded-circle" id="img_uploader" src="{{asset('assets/img/undraw_profile.svg')}}" />
                                        </div>
                                        <input type="file" name="image" id="image" class="d-none" />
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control @error('name') is-invalid  @enderror" value="{{old('name')}}" required>
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alias">{{__('Alias')}}</label>
                                        <input type="text" name="alias" id="alias" class="form-control @error('alias') is-invalid  @enderror" value="{{old('alias')}}" required readonly />
                                        @error('alias')
                                            <p class="invalid-feedback">{{ $message}}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">{{__('Description')}}</label>
                                        <textarea  name="description" id="description" class="form-control">{{old('description')}}</textarea>
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
