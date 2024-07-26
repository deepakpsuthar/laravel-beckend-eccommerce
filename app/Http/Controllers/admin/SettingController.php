<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
class SettingController extends Controller
{
    function __construct(){
        $this->settings = getSettings();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value','key');
        $timezones = Config::get('timezones');
        $date_formats = Config::get('app.date_formats');
        $time_formats = Config::get('app.time_formats');
        $languages = Config::get('app.languages');
        return view('admin.settings.index',compact('settings','timezones','date_formats','time_formats','languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =$request->all() ;
        unset($data['_token'],$data['_method']);
        foreach($data as $field=>$val){
            $post = array(
                'key'=>$field
            );
            if($field=='site_logo' && $request->hasfile('site_logo'))
            {
                $val = uploadFile($request,'site_logo','sitelogo');

            }
            if($field =='favicon_icon' && $request->hasfile('favicon_icon'))
            {
                $val = uploadFile($request,'favicon_icon','sitelogo');
            }
            Setting::updateOrInsert($post,['value'=>$val]);
        }
        Artisan::call('cache:clear');
       return redirect()->route('admin.settings.index')->with('success','setting saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
