<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Booking extends Model {

    protected $table = 'bookings';

    protected $fillable = ['depart', 'user_id', 'alcohol', 't_shirt', 'diet', 'booked', 'confirmation_code'];

    protected $hidden = 'id';
    /**
     * @param $booking
     * @param $user_id
     * @throws \Exception
     */
    public static function createBooking($booking, $user_id)
    {
        Booking::create(['user_id' => $user_id,
            'depart' => $booking->depart,
            'alcohol' => $booking->alcohol,
            't_shirt' => $booking->t_shirt,
            'diet' => $booking->diet,
            'confirmation_code' => Uuid::generate(4)
        ]);
    }
}