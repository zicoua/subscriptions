<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeEditRequest;
use App\Http\Requests\SubscribeRequest;
use App\Subscription;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $subscriptions = $this->subscriptionModel;

        return view('admin.index', compact('subscriptions'));
    }

    public function storeSubscription(SubscribeRequest $request)
    {

        $subscription = new $this->subscriptionModel($request->only(['name', 'email']));

        // generate page token and save subscription
        $subscription
            ->generateToken()
            ->setExpiredDate()
            ->save();

        session()->flash('success', 'Subscription was created');

        return redirect()->back();

    }

    public function editSubscription($id)
    {

        $subscription = $this->subscriptionModel->find($id);

        if(empty($subscription))
            return abort(404);

        return view('admin.subscriptions.edit', compact('subscription'));

    }

    public function updateSubscription($id, SubscribeEditRequest $request)
    {

        $subscription = $this->subscriptionModel->find($id);

        if(empty($subscription))
            return abort(404);

        $subscription->update($request->only(['name', 'email', 'expired_at', 'is_active']));

        session()->flash('success', 'Subscription was modified');

        return redirect()->route('admin.index');
    }

    public function deleteSubscription($id)
    {
        $subscription = $this->subscriptionModel->find($id);

        if(empty($subscription))
            return response()->json('Subscription doesn\'t fount', 404);

        $subscription->delete();

        return response()->json('Subscription was removed');
    }
}
