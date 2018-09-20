<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Subscription;

class HomeController extends Controller
{

    protected $subscriptionModel;

    /**
     * Create a new controller instance.
     *
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {

        $this->subscriptionModel = $subscription;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function subscribe(SubscribeRequest $request)
    {

        $subscription = new $this->subscriptionModel($request->only(['name', 'email']));

        // generate page token and save subscription
        $subscription
            ->generateToken()
            ->setExpiredDate()
            ->save();

        session()->flash('token', $subscription->token);

        return redirect()->back();

    }

    public function page($token)
    {
        $subscription = $this->subscriptionModel->byToken($token)->first();

        if($subscription && $subscription->can_access)
            return view('page', compact('token'));

        return abort(403);
    }
}
