<?php namespace App\Handlers\Events;

use App\Booking;
use App\Events\UserHasBooked;

use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailBookingConfirmation {

    /**
     *
     */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserHasBooked  $event
	 * @return void
	 */
	public function handle(UserHasBooked $event)
	{
        $user = User::findOrFail($event->user_id);
        $booking = Booking::findOrFail($event->booking_id);

        mail::send('emails.booking', [  'name'      => $user->name,
                                        'depart'    => $booking->depart,
                                        'alcohol'   => $booking->alcohol,
                                        't_shirt'   => $booking->t_shirt,
                                        'diet'      => $booking->diet
                                        ],
            function($message) use ($user, $booking)
        {
            $message->to($user->email, $user->name)->subject('Validate your booking');
        });
	}

}
