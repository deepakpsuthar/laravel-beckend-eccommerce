<x-admin.layout.master page-title="Settings">
    <!-- ========== Left Sidebar Start ========== -->
  <x-admin.layout.sidebar />
  <!-- Left Sidebar End -->
    <div id="content-wrapper" class="d-flex flex-column">
       <!-- Main Content -->
       <div id="content" class="setting-page">
           <x-admin.layout.header />
           <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{__('Settings')}}</h1>
                </div>
                <section class="site-details mb-4">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="d-flex mb-3">
                                <div class="nav flex-md-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                     <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ __('General') }}</button>
                                    <button class="nav-link " id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">{{  __('Payment') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>{{__('Site Settings')}}</h2>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                @method('POST')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 col-md-12 ">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="card mb-3">
                                                                    <div class="card-header">
                                                                        <h5 class="small-title">{{__('Site Logo')}}</h5>
                                                                    </div>
                                                                    <div class="card-body p-1">
                                                                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                                                            <div class="logo-content img-fluid logo-set-bg  text-center py-2 overflow-hidden">
                                                                                <img alt="image" src="{{isset($settings['site_logo']) ? '/'.$settings['site_logo'] : ''}}" class="small-logo w-max-250 h-max-71" id="pre_site_logo">
                                                                            </div>
                                                                            <div class="choose-files mt-3">
                                                                                <label for="site_logo">
                                                                                    <div class=" bg-primary "> <i class="fa-solid fa-upload me-3"></i>{{__('Choose file here')}}</div>
                                                                                    <input type="file" class="form-control file d-none" name="site_logo" id="site_logo" data-filename="site_logo" onchange="document.getElementById('pre_site_logo').src = window.URL.createObjectURL(this.files[0])">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="card ">
                                                                    <div class="card-header">
                                                                        <h5 class="small-title">{{__('Favicon Icon')}}</h5>
                                                                    </div>
                                                                    <div class="card-body p-1">
                                                                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                                                            <div class="logo-content img-fluid logo-set-bg  text-center py-2 overflow-hidden">
                                                                                <img alt="image" src="{{isset($settings['favicon_icon']) ? '/'.$settings['favicon_icon'] : ''}}" class="small-logo w-max-250 h-max-71" id="pre_favicon_icon">
                                                                            </div>
                                                                            <div class="choose-files mt-3">
                                                                                <label for="favicon_icon">
                                                                                    <div class=" bg-primary "> <i class="fa-solid fa-upload me-3"></i>{{__('Choose file here')}}</div>
                                                                                    <input type="file" class="form-control file d-none" name="favicon_icon" id="favicon_icon" data-filename="favicon_icon" onchange="document.getElementById('pre_favicon_icon').src = window.URL.createObjectURL(this.files[0])">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12 ">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="site_title">{{__('Site Title')}}</label>
                                                                    <input type="text" name="site_title" class="form-control" id="site_title" value="{{isset($settings['site_title']) ? $settings['site_title'] : ''}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="site_description">{{__('Site Description')}}</label>
                                                                    <textarea  name="site_description" class="form-control" id="site_description">{{isset($settings['site_description']) ? $settings['site_description'] : ''}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="admin_email">{{__('Admin Email')}}</label>
                                                                    <input type="email" name="admin_email" class="form-control" id="admin_email" value="{{isset($settings['admin_email']) ? $settings['admin_email'] : ''}}" placeholder="admin@example.com" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="time_zone">{{__('Time Zone')}}</label>
                                                                    <select name="time_zone" id="time_zone" class="form-select">
                                                                        @if($timezones)
                                                                            @foreach ($timezones as $key => $val)
                                                                                <option value="{{$key}}"  {{isset($settings['time_zone']) && $settings['time_zone'] ==$key ? 'selected' : ''}}>{{$val}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="date_format">{{__('Date Format')}}</label>

                                                                    <select name="date_format" id="date_format" class="form-select">
                                                                        @if($date_formats)
                                                                            @foreach ($date_formats as $key => $val)
                                                                                <option value="{{$key}}"  {{isset($settings['date_format']) && $settings['date_format'] ==$key ? 'selected' : ''}}>{{$val}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="time_format">{{__('Time Format')}}</label>
                                                                    <select name="time_format" id="time_format" class="form-select">
                                                                        @if($time_formats)
                                                                            @foreach ($time_formats as $key => $val)
                                                                                <option value="{{$key}}"  {{isset($settings['time_format']) && $settings['time_format'] ==$key ? 'selected' : ''}}>{{$val}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="default_language">{{__('Site Language')}}</label>
                                                                    <select name="default_language" id="default_language" class="form-select">
                                                                        @if($languages)
                                                                            @foreach ($languages as $key => $val)
                                                                                <option value="{{$key}}"  {{isset($settings['default_language']) && $settings['default_language'] ==$key ? 'selected' : ''}}>{{$val}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="footer_text">{{__('CopyRight Footer Text')}}</label>
                                                                    <input type="text" name="footer_text" class="form-control" id="footer_text" value="{{isset($settings['footer_text']) ? $settings['footer_text'] : ''}}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-end mt-3">
                                                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                    <x-admin.settings.payment />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <setion class="site-notification">

                </setion>
            </div>
        </div>
    </div>
</x-admin.layout.master>
