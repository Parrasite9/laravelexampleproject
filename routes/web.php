<?php

use App\Models\ActivityLog;
use App\Models\Device;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Illuminate\Http\Request;
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

// Route::get('/relay/{power}', function ($power) {

//     $currentPower = $power;

//     if ($power == 1) {
//         # code... TURN POWER ON
//         $NewEntry = new ActivityLog();
//         $NewEntry->value = 1;
//         $NewEntry->save();
//     } else {
//         # code... TURN POWER OFF
//         $NewEntry = new ActivityLog();
//         $NewEntry->value = 0;
//         $NewEntry->save();
//     }

//     if ($power == 1) {
//         $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=1');
//             return 'Power is: On';
//     } else {
//         $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=0');
//             return 'Power is: Off';
//     }
// });

Route::get('/relay', function() {
    $devices = Device::all();
    return view ('devices', compact('devices'));
});

// CREATE A FORM TO UPDATE EXISTING DEVICES AND THEIR DATA

// Route::get('/relay/{ip}/{value}/details', function ($ip, $value) {
Route::get('/relay/{id}/details', function ($id) {
    $device = Device::findOrFail($id);
    return view('details', ['device' => $device]);
});

Route::post('/relay/{id}/details', function ($id, Request $request) {
    $device = Device::findOrFail($id);

    $device->ip = $request->input('ip');
    $device->save();

    return back()->with('success', 'Device updated successfully');
});

Route::get('/relay/{id}/{value}', function ($id, $value) {
    $value = (int) $value;

    // Find the device by IP
    $device = Device::findorFail($id);

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

