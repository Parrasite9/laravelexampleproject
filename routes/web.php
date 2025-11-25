<?php

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
    if ($power == 1) {
        $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=1');
            return 'Power is: On';
    } else {
        $response = Http::get('http://63.41.58.8:8052/state.xml?relay1=0');
            return 'Power is: Off';
    }



});