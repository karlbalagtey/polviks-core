<?php

namespace App\Mail\Customer;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerEmailUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.customer.confirm')->subject('Please confirm your new email');
    }
}
