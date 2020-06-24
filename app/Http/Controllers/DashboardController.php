<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
//
use App\Model\Settings_dashboard;
use App\Model\Users_dashboard;

class DashboardController extends Controller {

    protected $ajaxMethods = ['save' => true, 'remove' => true, 'add' => true];

    public function index($error = false)
    {
        $data = [
            'action' => '/dashboard',
            'signup' => false,
            'text' => 'Login',
        ];

        return view('dashboard_loggin', $data);
    }

    public function signup()
    {
        $data = [
            'action' => '/register',
            'signup' => true,
            'text' => 'Sign Up',
        ];

        return view('dashboard_loggin', $data);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|max:50|min:6',
        ]);

        /////////
        $dbr = Users_dashboard::where('email', $request->input('email'))->count();
        if ($dbr == 0)
        {
            $db = new Users_dashboard;
            $db->email = $request->email;
            $db->pass = Crypt::encryptString($request->password);
            $db->save();
            ////
            $lastUser = $db->id;
            $data = [];

            for ($i = 0; $i < 9; $i++)
            {//bg-secondary text-white
                $ar = [
                    'user_id' => $lastUser,
                    'class' => 'fa fa-plus-circle fa-2x',
                    'text' => '',
                    'url_link' => '#',
                    'color_text' => 'text-white',
                    'color_bg' => 'bg-secondary',
                ];
                $data[$i] = $ar;
            }

            // $db=new Settings_dashboard;
            settings_dashboard::insert($data);
            ////
         //   $dbSettings = settings_dashboard::where('user_id', $lastUser)->get()->toArray();
            return redirect('/dashboard-login');
        }
        else
        {
            return redirect('/dashboard-signup')->withErrors('The email exists!');
        }
    }

    public function dashboard(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|max:50|min:6',
        ]);
        /////////
        $dbr = Users_dashboard::where('email', $request->email)->first();
        if ($dbr != null)
        {
            $dbr = $dbr->toArray();
            $dec_pass = Crypt::decryptString($dbr['pass']);
            if ($dec_pass == $request->password)
            {
                $dbSettings = settings_dashboard::where('user_id', $dbr['id'])->get()->toArray();
                $request->session()->put('userData', $dbr);

                return view('dashboard', array('data' => $dbSettings));
            }
            else
            {
                return redirect('/dashboard-login')->withErrors('Wrong name or password!');
            }
        }
        else
        {
            return redirect('/dashboard-login')->withErrors('Wrong name or password!');
        }
    }

    public function ajax(Request $request)
    {


        $userData = $request->session()->get('userData');

        if (array_key_exists($request->options, $this->ajaxMethods))
        {
            if ($this->ajaxMethods[$request->options] === true)
            {

                $data = json_decode($request->data, false);
                if ($data->user_id == $userData['id'])
                {
                    $func = '_' . preg_replace('~[^A-Za-z0-9]~', '', $request->options);
                    return $this->$func($data);
                }
            }
        }
        return false;
    }

    protected function _save($data)
    {

        if (!filter_var($data->url_link, FILTER_VALIDATE_URL))
        {
            return 'Please insert a valid URL: "https://site.com"';
            if (strlen($data->url_link) > 1000)
                return 'The URL is too long. The allowed number of characters is 1000!';
        }
        if (strlen($data->text) > 200)
            return 'The text is too long. The allowed number of characters is 200!';
        $id = $data->id;
        unset($data->id);


        $rs = settings_dashboard::where('id', $id)
                ->update((array) $data);
        if ($rs === 1)
            return('ok');
    }

    protected function _remove($data)
    {
        $rs = settings_dashboard::where('id', $data->id)->delete();
        if ($rs === 1)
            return('ok');
        else
            return 'Error cell remove!';
    }

    protected function _add($data)
    {
        $ar = [
            'user_id' => $data->user_id,
            'class' => 'fa fa-plus-circle fa-2x',
            'text' => '',
            'url_link' => '#',
            'color_text' => 'text-white',
            'color_bg' => 'bg-secondary',
        ];

        $dbr = settings_dashboard::insert($ar);
        if ($dbr)
        {
            $last = settings_dashboard::all()->last()->toArray();
            return json_encode($last);
        }
    }

}
