<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarketingSupport extends Mailable
{
    use Queueable, SerializesModels;

    protected $form;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $subject)
    {
        $this->form = $form;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.marketingSupport', ['form' => $this->form]);
    }
}
