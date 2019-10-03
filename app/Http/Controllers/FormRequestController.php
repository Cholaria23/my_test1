<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\StoreReviewRequest;
use Mail;
use App\Mail\MarketingSupport;
use Config;
use App\Models\FormRequest;
use App\Models\Subscriber;
use App\Models\MaintenanceCenter;
use App\Models\Review;
use App\Mail\Subscribe;
use App\Mail\Review as EmailReview;
use App\Mail\Form;
use App\Repositories\FileRepository;

class FormRequestController extends Controller
{
    protected $file;

    public function __construct(FileRepository $fileRepository)
    {
        $this->file = $fileRepository;
    }

    public function marketingSupportFormStore(StoreFormRequest $request)
    {
        $form = FormRequest::create([
            'subject' => Config::get('mail.marketingSupportForm_subject'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'phone' => $request->get('phone'),
            'message' => $request->get('text'),
            'user_info' => $_SERVER['HTTP_USER_AGENT']
        ]);

        Mail::to(['marketing@staleks.com'])->send(new Form($form, Config::get('mail.marketingSupportRequest_subject')));

        return response()->json(compact('form'));
    }

    public function workplaceFormStore(StoreFormRequest $request)
    {
        $fileUrl = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileUrl = $this->file->uploadFile($file, 'workplacesForm');
        }

        $form = FormRequest::create([
            'subject' => Config::get('mail.workplaceRequest_subject'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'phone' => $request->get('phone'),
            'message' => $request->get('text'),
            'user_info' => $_SERVER['HTTP_USER_AGENT'],
            'file' => $fileUrl
        ]);

        Mail::to(['personal@staleks.org'])->send(new Form($form, Config::get('mail.workplaceRequest_subject')));

        return response()->json(compact('form'));
    }

    public function subscribeFormStore(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create([
            'email' => $request->get('email'),
            'user_info' => $_SERVER['HTTP_USER_AGENT']
        ]);

        Mail::to(['marketing@staleks.com '])->send(new Subscribe($subscriber, Config::get('mail.subscriberRequest_subject')));

        return response()->json(compact('subscriber'));
    }

    public function reviewStore(StoreReviewRequest $request)
    {
        $maintenance_center = MaintenanceCenter::find($request->get('commentable_id'));
        $review = $maintenance_center->reviews()->create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'service' => $request->get('service'),
            'rating' => (int)$request->get('rating'),
            'content' => $request->get('content'),
        ]);

        Mail::to(['marketing@staleks.com', 'rozhko@staleks.org'])->send(new EmailReview($review, Config::get('mail.reviewRequest_subject')));
        return response()->json(compact('review'));
    }

    public function formRequestStore(StoreFormRequest $request)
    {
        $form = FormRequest::create([
            'subject' => $request->get('subject'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'phone' => $request->get('phone'),
            'message' => $request->get('text'),
            'user_info' => $_SERVER['HTTP_USER_AGENT'],
        ]);

        Mail::to(['marketing@staleks.com'])->send(new Form($form, $request->get('subject')));

        return response()->json(compact('form'));
    }

    public function formContactStore(Request $request)
    {
        $rules = [
            'country' =>'required|string',
            'subject' => 'required|string',
            'name' =>'required|string',
            'phone' =>'required|string',
            'email' =>'required|email|string',
            'term_1' => 'required|boolean',
            'term_2' => 'required|boolean',
        ];

        if ($request->has('sales')) {
            $rules = array_merge($rules, [
                'post' =>'required|string',
                'company_name' =>'required|string',
                'city' =>'required|string',
                'business' =>'required|string',
            ]);
        }

        $request->validate($rules);

        $data = [
            'subject' => $request->get('subject'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),
            'country' => $request->get('country'),
            'web' => $request->get('web'),
            'agree' => $request->get('term_3'),
            'user_info' => $_SERVER['HTTP_USER_AGENT'],
        ];

        if ($request->get('sales')) {
            $data = array_merge($data, [
                'post' => $request->get('post'),
                'company_name' => $request->get('company_name'),
                'city' => $request->get('city'),
                'business' => $request->get('business'),
            ]);
        }

        $form = FormRequest::create($data);
        $country_category = $request->get('country_category');
        if ($country_category === 'usa') {
            Mail::to(['info@staleks.com', 'order@staleks.org','admin@staleks.com'])->send(new Form($form, $request->get('subject')));
        } else if ($country_category === 'ukraine') {
            Mail::to(['zakaz@staleks.org', 'denys.chuikov@staleks.org','marketing@staleks.com','admin@staleks.com'])->send(new Form($form, $request->get('subject')));
        } else if ($country_category === 'russia') {
           // Mail::to(['zakaz_rus@staleks.org', 'valentin.noll@staleks.org'])->send(new Form($form, $request->get('subject')));
	    Mail::to(['voropai.a@gmail.com','admin@staleks.com'])->send(new Form($form, $request->get('subject')));
        } else if ($country_category === 'europe') {
            Mail::to(['anton.loskutov@staleks.com', 'roman.mandrik@staleks.com','admin@staleks.com'])->send(new Form($form, $request->get('subject')));
        } else {
            Mail::to(['borysenko@staleks.org', 'roman.nesterenko@staleks.com', 'shokalo@staleks.org', 'marina@staleks.org', 'sergii.popov@staleks.org','Oleksii.bulatetskyi@staleks.org','admin@staleks.com'])->send(new Form($form, $request->get('subject')));
        }

        return response()->json(compact('form'));
    }
}
