<?php

namespace App\Library;

class AccountEdit
{
    protected $request;
    protected $user;
    protected $input;

    public function __construct($request)
    {
        $this->request = $request;

        /* Get user object */
        $this->get_user();
    }

    public function get_user()
    {
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if(!$user_id){
            return false;
        }
        $user = \App\User::find($user_id);
        $this->user = $user;
    }

    public function check_input()
    {
        $field = $this->request->field;
        if($field == 'avatar'){
            $image = $this->request->file('avatar');
            $new_name = $this->user->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/avatars'), $new_name);
            $value = url('img/avatars').'/'.$new_name;
        } else {
            $value = $this->request->value;
        }
        return $this->edit($field, $value);
    }

    public function edit($field, $value)
    {
        switch ($field) {
            case 'name':
                return $this->edit_name($value);
                break;
            case 'email':
                return $this->edit_email($value);
                break;
            case 'organization':
                return  $this->edit_organization($value);
                break;
            case 'address':
                return $this->edit_address($value);
                break;
            case 'role':
                return $this->edit_role($value);
                break;
            case 'avatar':
                return $this->edit_avatar($value);
                break;
            case 'account_password':
                return $this->password_check($value);
                break;
            case 'change_password':
                return $this->password_change($value);
                break;
        }
    }

    public function run()
    {
        return $this->check_input();
    }

    /*
     * Check password
     * */

    public function password_check($request)
    {
        $hasher = app('hash');
        if ($hasher->check($request, $this->user->password)) {
            $returnHTML = view('dashboard.partials.ajax-change-password')->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        } else {
            return 'Wrong password';
        }
    }

    /*
     *
     * Change password
     * */
    public function password_change($value)
    {
        $old_password = $this->request->account_old_password;
        $new_password = $this->request->account_password;
        $new_re_password = $this->request->account_re_password;

        /* Check old_password */
        $hasher = app('hash');
        if ($hasher->check($old_password, $this->user->password)) {
            if($new_password === $new_re_password){
                $this->change_password_action($new_password);
            } else {
                return response()->json(array('error' => true, 'errors'=> array('account_password' => "Doesn't match", 'account_re_password' => "Doesn't match")));
            }
        } else {
            return response()->json(array('error' => true, 'errors'=> array('account_old_password' => 'Wrong old password')));
        }
    }

    public function change_password_action($new_password)
    {
        return response()->json(array('success' => true, 'message'=> $new_password));
    }

    /*
     * Edit name for user
     * */
    public function edit_name($value)
    {
        $this->user->name = $value;
        $this->user->save();
        return 'Changed name';
    }

    /*
     * Edit email for user
     * */
    public function edit_email($value)
    {
        $this->user->email = $value;
        $this->user->save();
        return 'Changed email';
    }

    /*
     * Edit organization for user
     * */
    public function edit_organization($value)
    {
        $this->user->organization = $value;
        $this->user->save();
        return 'Changed organization';
    }

    /*
     * Edit name for user
     * */
    public function edit_role($value)
    {
        $this->user->role = $value;
        $this->user->save();
        return 'Changed name';
    }

    /*
     * Edit address for user
     * */
    public function edit_address($value)
    {
        $this->user->address = $value;
        $this->user->save();
        return 'Changed address';
    }

    /*
     * Edit address for user
     * */
    public function edit_avatar($value)
    {
        $this->user->avatar = $value;
        $this->user->save();
        return 'Changed avatar';
    }
}