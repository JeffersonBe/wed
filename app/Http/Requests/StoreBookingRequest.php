<?php namespace App\Http\Requests;

class StoreBookingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name'				=> 'required|max:15|alpha',
            'email'					=> 'required|email',
            'password'				=> 'required|max:30',
            'depart'				=> 'required',
            'alcohol'				=> 'required',
            't_shirt'				=> 'required',
            'diet'					=> 'required',
            'g-recaptcha-response'  => 'required|recaptcha',
		];
	}

}
