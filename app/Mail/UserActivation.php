<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Activation;

class UserActivation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $activation;
     /**
      * Create a new message instance.
      *
      * @param Activation $activation
      * @return void
      */
    public function __construct(Activation $activation)
    {
        $this->activation = $activation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->with([
            'code' => $this->activation->code,
        ])
        ->view('email.user.activation');
    }
}
