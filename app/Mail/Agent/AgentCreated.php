<?php

namespace App\Mail\Agent;

use App\Models\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgentCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.agent.welcome')->subject('Please confirm your account');
    }
}
