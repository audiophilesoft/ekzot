<?php

namespace App\Http\Controllers\Auth;

use App\Events\ResendRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidatesRecaptcha;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use ValidatesRecaptcha;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('resend','confirm');
    }


    public function register(Request $request)
    {
        // todo: returns success code if the script was stopped manually
        $this->validateRecaptcha($request);
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        try {
            $this->saveAvatar($user, $request);
        } catch (\Throwable $th) {
            $user->delete();
            throw $th;
        }


        event(new Registered($user));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    public function showRegistrationForm(Request $request)
    {
        return view($request->ajax() ? 'auth.registration_form' : 'auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // todo: write custom messages
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'min:' . config('site.users.name.min_length'),
                'max:' . config('site.users.name.max_length'),
                'regex:' . config('site.users.name.regex'),
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:' . config('site.users.password.min_length'),
                'max:' . config('site.users.password.max_length'),
                'regex:' . config('site.users.password.regex')
            ],
            'avatar' => [
                'image',
                'mimetypes:' . config('site.users.avatar.accept_mimes'),
                'mimes:' . config('site.users.avatar.accept_extensions'),
                'max:' . config('site.users.avatar.max_size'),
                'dimensions:max_width=' . config('site.users.avatar.max_width') . ',max_height=' . config('site.users.avatar.max_height')
            ]
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_key' => static::getRandomString(config('site.registration.confirmation.key_length'))
        ]);
    }


    protected function saveAvatar(User $user, Request $request)
    {
        if ($image = $request->file('avatar')) {
            $user->setAvatarImage($image);
            $user->saveAvatar();
        }

    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function confirm(Request $request)
    {
        if ($user = User::where('confirmation_key', $request->get('key'))
            ->first()) {
            if (!$user->is_active) {
                $user->is_active = true;
                $user->save();
                $this->guard()->login($user);
                $message = 'Спасибо, аккаунт активирован, вход выполнен. Теперь Вы можете писать комментарии и задавать вопросы.';
            } else {
                $message = 'Этот аккаунт уже активирован.';
            }

        } else {
            $message = 'Неверный ключ активации.';
        }
        flash($message)->info();
        return redirect($this->redirectPath());
    }


    protected static function getRandomString(int $length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $chars_num = \strlen($chars);
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[(int)floor(mt_rand() / mt_getrandmax() * $chars_num)];
        }

        return $string;
    }


    public function resend()
    {
        // TODO: use middleware here
        if (\Auth::user()->is_active) {
            return redirect()->back();
        }

        // todo: Check the time the email has been sent
        event(new ResendRequest(\Auth::user()));

        flash('Письмо со ссылкой для активации было отправлено повторно')->info();

        return redirect()->back();
    }
}
