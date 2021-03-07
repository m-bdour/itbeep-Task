<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceInterest;
use Illuminate\Http\Request;
use Mail;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        $interests = ServiceInterest::all();
        return view('index', compact('services', 'interests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_email(Request $request)
    {
        $to_email = $request->email;
        $to_name = $request->name;
        $services = json_encode($request->service);
        $interest = $request->interest;
        $body = "hello $to_name you booked this sevice\services $services and you are $interest";
        Mail::send([], [], function ($msg) use ($to_name, $to_email, $body) {
            $msg->to($to_email, $to_name)->subject("itbeep task");
            $msg->from("orangebackup20@gmail.com", "itbeep");
            $msg->setBody($body);
        });
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
