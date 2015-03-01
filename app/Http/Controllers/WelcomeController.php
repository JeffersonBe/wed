<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\User;
use App\Booking;
use App\Events\Event;
use App\Events\UserHasBooked;

class WelcomeController extends Controller {

    /**
     *
     */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

    /**
     * @param StoreBookingRequest $request
     * @return \Illuminate\View\View
     */
	public function store(StoreBookingRequest $request)
	{
		User::createUser($request);
        $user = User::where('email', '=', $request->email)->firstOrFail();
        Booking::createBooking($request,$user->id);
        $booking = Booking::where('user_id', '=', $user->id)->firstOrFail();

        \Event::fire(new UserHasBooked($user->id, $booking->id));
        return redirect()->back();
	}
}
