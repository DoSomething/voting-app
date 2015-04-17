<?php namespace App\Http\Requests;

class UserRegisterRequest extends Request
{

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
      'phone' => 'unique:users',
      'email' => 'unique:users',
    ];
  }

  /**
   * Set custom messages for validator errors.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'phone.unique' => 'That phone number is already registered with a different user. Check your other information and try again.',
      'email.unique' => 'That email is already registered with a different user. Check your other information and try again.',
    ];
  }

}
