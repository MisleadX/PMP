<?php

namespace App\Http\Controllers\Website;

use App\Codes\Models\Contact;
use App\Codes\Models\Settings;
use App\Codes\Logic\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class ContactController extends WebController
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function postContact()
    {
        $data = $this->validate($this->request, [
            'g-recaptcha-response' => 'required|captcha',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/(0)[0-9]/',
            'message' => 'required',
        ]);

        $contact = Contact::create([
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => 1,
        ]);

        $settings = Cache::remember('settings', env('SESSION_LIFETIME'), function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        $subject = $contact->subject;
        $recipient = $settings['contact-email'] ?? 'contact@perdanamandiriperkasa.com';

        Mail::send('mail.forgot', [
            'contact' => $contact,
            'email' => $contact->email,
        ], function ($m) use ($subject, $recipient) {
            $m->to($recipient, 'Admin')->subject($subject);
        });

        session()->flash('message', __('general.success_send_', ['field' => __('general.email')]));
        session()->flash('message_alert', 2);
        return redirect()->route('homepage');
    }
}
