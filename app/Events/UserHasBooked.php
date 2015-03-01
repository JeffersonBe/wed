<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserHasBooked extends Event {

	use SerializesModels;
    public $user_id;
    public $booking_id;

    /**
     * @param $user_id
     * @param $booking_id
     */
	public function __construct($user_id, $booking_id)
	{
		$this->user_id = $user_id;
        $this->booking_id = $booking_id;
	}

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserHasBooked' => [
            'App\Handlers\Events\EmailBookingConfirmation',
        ],
    ];

}
