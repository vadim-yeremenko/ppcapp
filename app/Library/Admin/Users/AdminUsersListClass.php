<?php

namespace App\Library\Admin\Users;

use App\Library\SpendingsGet;
use App\User;
use Illuminate\Support\Facades\Mail;

class AdminUsersListClass
{
    protected $request;
    protected $user_email;

    /*
     * Counter for new registrations
     * */
    public function get_request_count()
    {
        $users = User::role('customer');
        $users = $users->where('active', '=', '0')->get();
        return count($users);
    }

    public function active_users_list()
    {
        $users = User::role('customer')
            ->where('active', '!=', '0')
            ->limit('10')
            ->get();
        return $users;
    }

    public function non_active_users_list()
    {
        $users = User::role('customer')
            ->where('active', '=', '0')
            ->get();
        return $users;
    }

    /*
     *
     * List for registered users list (only active users)
     *
     * */
//    public function get_active_users_list()
//    {
//        $spendings = new SpendingsGet();
//
//        // Getting all users
//        $users = User::role('customer');
//        $users = $users->where('active', '=', '1')->get();
//        // Prepare array with all users for template
//        $users_list = array();
//        foreach ($users as $user) {
//            $spendings_user_week = $spendings->get_spendings_by_user_week($user->id);
//            $spendings_user_week_icon = $spendings->get_spendings_by_user_icon($user->id);
//            $users_list[$user->id]['avatar'] = $user->avatar;
//            $users_list[$user->id]['name'] = $user->name;
//            $users_list[$user->id]['organization'] = $user->organization;
//            $users_list[$user->id]['company'] = $user->organization;
//            $users_list[$user->id]['role'] = $user->role;
//            $users_list[$user->id]['email'] = $user->email;
//            $users_list[$user->id]['campaigns'] = $user->campaigns;
//            $users_list[$user->id]['spendings_week'] = $spendings_user_week;
//            $users_list[$user->id]['spendings_week_icon'] = $spendings_user_week_icon;
//            $users_list[$user->id]['spendings_total'] = $user->spendings_total;
//            $users_list[$user->id]['balance'] = $user->balance;
//            $users_list[$user->id]['url'] = '/admin/users/'.$user->id;
//            $users_list[$user->id]['id'] = $user->id;
//        }
//        return $users_list;
//    }
//
//
//    /*
//     *
//     * List for registered users list (not active users)
//     *
//     * */
//    public function get_nonactive_users_list()
//    {
//        // Getting all users
//        $users = User::role('customer');
//        $users = $users->where('active', '=', '0')->get();
//        // Prepare array with all users for template
//        $users_list = array();
//        foreach ($users as $user) {
//            $users_list[$user->id]['avatar'] = $user->avatar;
//            $users_list[$user->id]['name'] = $user->name;
//            $users_list[$user->id]['organization'] = $user->organization;
//            $users_list[$user->id]['company'] = $user->organization;
//            $users_list[$user->id]['role'] = $user->role;
//            $users_list[$user->id]['email'] = $user->email;
//            $users_list[$user->id]['email_truncated'] = substr($user->email,0,10).'...';
//            $users_list[$user->id]['campaigns'] = $user->campaigns;
//            $users_list[$user->id]['spendings_week'] = $user->spendings_week;
//            $users_list[$user->id]['spendings_total'] = $user->spendings_total;
//            $users_list[$user->id]['balance'] = $user->balance;
//            $users_list[$user->id]['url'] = '/admin/users/'.$user->id;
//            $users_list[$user->id]['id'] = $user->id;
//        }
//        return $users_list;
//    }

    /*
     *
     * Return view with users
     *
     * */
    public function get_users_list_by_type($request)
    {
        $type = $request->type;
        if($type == 'active'){
            $returnHTML = view('admin.users.users_list')
                ->with('users_list', $this->active_users_list())
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        } else {
            $returnHTML = view('admin.partials.users_requests_ajax')
                ->with('users_list', $this->non_active_users_list())
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    /*
     *
     * Return user list by id
     *
     * */
    public function get_user_by_id($id)
    {
        $users = User::role('customer');
        $users = $users->where('id', '=', $id)->first();
        return $users;
    }

    /*
     *
     * AJAX function for ACCEPT user's registration and
     * sending Email about this action
     *
     * */
    public function accept_request($request)
    {
        $action = $request->action;
        $id = $request->id;
        $users = User::role('customer');
        $users = $users->where('id', '=', $id)->first();
        $this->user_email = $users->email;
        $data = array(
            'name' => $users->name,
            'email' => $users->email
        );
        if($users) {
            if($action == 'accept'){
                Mail::send('emails.accepted_user_notification', $data,
                    function ($message) {
                        $message->from('test100490@gmail.com', 'CPC App');
                        $message->to($this->user_email, 'Receiver')->subject('Your registration as accepted');
                    }
                );
                $users->active = 1;
                $users->save();
            }
        } else {
            return false;
        }
        return response()->json(array('success' => true, 'html'=>$id));
    }

    /*
    *
    * AJAX function for DECLINE user's registration and
    * sending Email about this action
    *
    * */
    public function user_request_decline($request)
    {
        $action = $request->action;
        $message = $request->message;
        $id = $request->id;

        $data = array(
            'messages' => $request->message
        );

        $users = User::role('customer')
            ->where('id', '=', $id)
            ->where('active', '=', '0')
            ->first();


        if($users) {
            $this->user_email = $users->email;

            Mail::send('emails.declined_user_notification', $data,
                function ($message) {
                    $message->from('test100490@gmail.com', 'Sender');
                    $message->to($this->user_email, 'Receiver')->subject('Your registration was declined');
                }
            );
            if($action == 'decline'){
                $users->delete();
            }
            return response()->json(array('success' => true, 'id'=>$id));
        } else {
            return response()->json(array('error' => true, 'id'=>$id));
        }

    }

    public function get_users_for_dashboard()
    {
        $users = \App\User::orderBy('id', 'asc')
            ->limit('6')
            ->get();
        return $users;
    }

    /*
     * Method for user's page
     * */
    public function get_users_balance($id)
    {
        $charges = \App\Charge::orderBy('id', 'asc')
            ->where('user_id', '=', $id)
            ->limit('7')
            ->get();
        return $charges;
    }

    public function get_users_week_balance($id)
    {
        $first_day = date("Y-m-d h:i:s", strtotime("today"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-6 days"));

        $result = 0;

        $charges_summ = 0;
        $spendings_summ = 0;

        $charges = \App\Charge::orderBy('id', 'asc')
            ->where('user_id', '=', $id)
            ->whereBetween('date', [$last_day, $first_day])
            ->get();
//        $spendings = \App\Spending::orderBy('id', 'asc')
//            ->where('user_id', '=', $id)
//            ->whereBetween('date', [$last_day, $first_day])
//            ->get();

        foreach ($charges as $charge){
            $charges_summ += (int)$charge->value;
        }

//        foreach ($spendings as $spending){
//            $spendings_summ += (int)$spending->value;
//        }

        $result = $charges_summ;

        return $result;
    }

    public function get_users_week_previous_balance($id)
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $result = 0;

        $charges_summ = 0;
        $spendings_summ = 0;

        $charges = \App\Charge::orderBy('id', 'asc')
            ->where('user_id', '=', $id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
//        $spendings = \App\Spending::orderBy('id', 'asc')
//            ->where('user_id', '=', $id)
//            ->whereBetween('date', [$first_day, $last_day])
//            ->get();

        foreach ($charges as $charge){
            $charges_summ += (int)$charge->value;
        }

//        foreach ($spendings as $spending){
//            $spendings_summ += (int)$spending->value;
//        }

        $result = $charges_summ;

        return $result;
    }

    public function get_users_week_balance_difference($id)
    {
        $week_1 = $this->get_users_week_balance($id);
        $week_2 = $this->get_users_week_previous_balance($id);

        if(!empty($week_1) && !empty($week_2)){
            $difference = $week_1 - $week_2;

            $val = $difference/$week_1;
            $return = $val * 100;
            if($return > 0){
                return '+'.round($return, 2) . '%';
            } else {
                return round($return, 2) . '%';
            }

        } else {
            return '0%';
        }
    }

    public function get_users_week_balance_class($id)
    {
        $value = $this->get_users_week_balance_difference($id);
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'change-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'change-up';
        }

        return $return;
    }

    public function get_clicks_by_user($id)
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-6 days"));
        $last_day = date("Y-m-d h:i:s" , strtotime("today"));
        $clicks = \App\Click::orderBy('id', 'asc')
            ->where('user_id', $id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();

        return count($clicks);
    }

    public function get_user_average_clicks($id)
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-6 days"));
        $last_day = date("Y-m-d h:i:s" , strtotime("today"));
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('user_id', $id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();

        $summary = 0;

        foreach($spendings as $spending)
        {
            $summary += $spending->value;
        }

        $spendings_count = count($spendings);
        if($summary > 0){
            $return = $summary / $spendings_count;
        } else {
            $return = 0;
        }


        return $return;
    }

    /*
     * Method for filtering
     * */

    public function get_filtered_users_list($request)
    {
        $returnHTML = view('admin.partials.users_ajax')
            ->with('users_list', $this->get_active_users_list())
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}