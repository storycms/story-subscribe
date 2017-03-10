<?php

namespace Story\Subscribe\Http;

use Illuminate\Http\Request;
use Story\Core\CoreController;
use \DrewM\MailChimp\MailChimp;

class SubscribeController extends CoreController
{
	public function index(SubscribeRequest $request)
    {
        $email = $request->input('email');

        if (!$email) {
            session()->flash('message', 'Please enter your email address');
        } else {
            $api_key = config()->get('subscribe.api_key');
            $list_id = config()->get('subscribe.subscribe_id');

            $subscribed = new MailChimp($api_key);
            $subscribed->verify_ssl = false;
            $subscribed->post("lists/".$list_id."/members", [
                'email_address' => $email,
                'status'        => 'subscribed',
            ]);

            if ($subscribed->success()) {
               session()->flash('info', 'Thank you for Subscribing!');
            } else {
                session()->flash('info', 'Something went wrong. Please try again');
            }
        }

        return redirect()->back();
    }
}