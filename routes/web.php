<?php

use App\Models\ActivityLog;
use App\Models\Device;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Illuminate\Support\Facades\Http;


Route::get('/', function () {
    $jobs = Job::all();

    dd($jobs);
});


Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {

        $job = Job::find($id);

        return view('job', ['job' => $job]);

});

Route::get('/contact', function() {
    return view ('contact');
});

Route::get('/relay/{power}', function ($power) {

    $currentPower = $power;

    if ($power == 1) {
        # code... TURN POWER ON
        $NewEntry = new ActivityLog();
        $NewEntry->value = 1;
        $NewEntry->save();
    } else {
        # code... TURN POWER OFF
        $NewEntry = new ActivityLog();
        $NewEntry->value = 0;
        $NewEntry->save();
    }

    if ($power == 1) {
        $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=1');
            return 'Power is: On';
    } else {
        $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=0');
            return 'Power is: Off';
    }
});

Route::get('/relay', function() {
    $devices = Device::all();
    return view ('devices', compact('devices'));
});

Route::get('/relay/{ip}/{value}', function ($ip, $value) {
    $value = (int) $value;

    // Find the device by IP
    $device = Device::where('ip', $ip)->firstOrFail();

    $device->value = $value;
    $device->save();


    if ($value == 1) {
        # code... TURN POWER ON
        $NewEntry = new ActivityLog();
        $NewEntry->value = 1;
        $NewEntry->save();
    } else {
        # code... TURN POWER OFF
        $NewEntry = new ActivityLog();
        $NewEntry->value = 0;
        $NewEntry->save();
    }

    if ($value == 1) {
        $response = Http::get("http://{$device->ip}/state.xml?relay1=1");
            return 'Power is: On';
    } else {
        $response = Http::get("http://{$device->ip}/state.xml?relay1=0");
            return 'Power is: Off';
    }

    return [
        'device_found' => $device->ip,
        'device_value_set' => $device->value,
        'device_save_success' => $saved,
        'log_saved' => $logSaved,
    ];

});

Route::get('/history', function () {
    $ActivityLog = ActivityLog::all();

    return $ActivityLog;
});