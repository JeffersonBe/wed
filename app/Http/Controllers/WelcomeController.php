<?php namespace App\Http\Controllers;

use Request;
use App\Http\Requests\StoreBookingRequest;
use App\User;
use App\Booking;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

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

        return redirect()->back();
	}
}
