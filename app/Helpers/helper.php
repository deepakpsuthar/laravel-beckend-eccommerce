<?php
use App\Models\Setting;
use Carbon\Carbon;

if (! function_exists('uploadFile')) {

    function uploadFile($request,$key,$folder_name=''){

        if($request->hasfile($key))
        {
            $mainPath = 'uploads/'.$folder_name;
            $file = $request->file($key);
            $extenstion = $file->getClientOriginalExtension();
            $filename = uniqid().time().'.'.$extenstion;
            if(!empty($name)){
                $filename = $name;
            }
            $file->move($mainPath, $filename);
            return $mainPath.'/'.$filename;
        }
        return null;
    }
}
if (!function_exists('getSettings')) {
    function getSettings()
    {
        // Laravel cache
        return Cache::rememberForever('site_settings', function () {
            $settings = Setting::all()->pluck('value', 'key')->toArray();

            return $settings;
        });
    }
}
if (!function_exists('default_dateformat')) {
    function default_dateformat($date)
    {
        $settings = getSettings();
        if($date){
            return Carbon::parse($date)->format($settings['date_format']);
        }
        return $date;
    }
}
