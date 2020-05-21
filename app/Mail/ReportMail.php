<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $listNews;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($listNews)
    {
        $this->listNews = $listNews;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('pages.report'))
            ->view('admin.report', ['listNews' => $this->listNews]);
    }
}
