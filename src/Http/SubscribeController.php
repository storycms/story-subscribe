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
            $api_key = config('subscribeconfig.api_key');
            $list_id = config('subscribeconfig.subscribe_id');

            $subscribed = new MailChimp($api_key);

            $MailChimp->post("lists/".$list_id."/members", [
                'email_address' => $email,
                'status'        => 'subscribed',
            ]);

            session()->flash('info', 'Thank you for Subscribing!');
        }

        return redirect()->back();
    }
}