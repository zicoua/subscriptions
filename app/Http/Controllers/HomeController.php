<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\SubscribeRequest;
use App\Mail\Subscribed;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $subscription->files()->save(factory(File::class)->make()); // make file for subscription
        Mail::to($request->get('email'))->send(new Subscribed($subscription));

        session()->flash('token', $subscription->token);

        return redirect()->back();

    }

    public function page($token)
    {
        $subscription = $this->subscriptionModel->byToken($token)->first();

        if($subscription && $subscription->can_access){
            $subscription->updateFileTokens();

            return view('page', compact('subscription'));
        }

        return abort(403);
    }

    public function file($token, File $fileModel)
    {
        $file = $fileModel->byToken($token)->first();

        if(!$file)
            return abort(403);

        return view('file', compact('file'));
    }

    public function unsubscribe(Request $request)
    {
        //TODO:: need use email also for unsubscribe (for security)
        $subscription = $this->subscriptionModel->byToken($request->get('token'))->first();

        if(empty($subscription))
            return abort(404);

        $subscription->update(['is_active' => 0]);

        return redirect('');
    }
}
