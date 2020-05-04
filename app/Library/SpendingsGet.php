<?php

/*=====================================================
 * Function for all operations with spendings,
 * like get by product, subproduct, campaign, user
 *
 * */

namespace App\Library;

use App\Spending;

class SpendingsGet
{
    /*
     * Get spendings for a week by product ID
     *
     * */
    public function get_spendings_for_week_by_product($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('product_id', '=', $product_id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = 0;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Get spendings by product
     * for previous week for label (it was grow up or down)
     *
     * */

    public function get_spendings_previous_week_by_product($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('product_id', '=', $product_id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Get spendings total by product ID
     *
     * */
    public function get_spendings_total_by_product($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('product_id', '=', $product_id)
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Add icon depend how was changed values for prduct
     * */
    public function get_spendings_change_by_product($product_id)
    {
        if(empty($product_id)){
            return '';
        }
        $last_week = $this->get_spendings_for_week_by_product($product_id);
        $previuos_week = $this->get_spendings_previous_week_by_product($product_id);
        if($last_week > $previuos_week){
            return 'icon-grow-up';
        } else if ($previuos_week > $last_week) {
            return 'icon-grow-down';
        } else {
            return 'hidden';
        }
    }


    /* ===================== Subproducts ======================
     * Get spendings for a week by subproduct ID
     *
     * */
    public function get_spendings_for_week_by_subproduct($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $product_id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Get spendings by product
     * for previous week for label (it was grow up or down)
     *
     * */

    public function get_spendings_previous_week_by_subproduct($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $product_id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Get spendings total by product ID
     *
     * */
    public function get_spendings_total_by_subproduct($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $product_id)
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Add icon depend how was changed values for subprduct
     * */
    public function get_spendings_change_by_subproduct($product_id)
    {
        if(empty($product_id)){
            return '';
        }
        $last_week = $this->get_spendings_for_week_by_subproduct($product_id);
        $previuos_week = $this->get_spendings_previous_week_by_subproduct($product_id);
        if($last_week > $previuos_week){
            return 'icon-grow-up';
        } else if ($previuos_week > $last_week) {
            return 'icon-grow-down';
        } else {
            return 'hidden';
        }
    }


    /*
     * Get yesterday spendings for admin's report
     * */

    public function get_all_spendings_yesterday()
    {
        $yesterday_date = date("Y-m-d", strtotime("-1 day"));
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('date', 'LIKE', $yesterday_date.'%')
            ->get();
        $sumary = 0;
        foreach($spendings as $spending){
            $sumary += $spending->value;
        }
        return $sumary;
    }


    /*
     * Get day before spendings for admin's report
     * */

    public function get_all_spendings_day_before()
    {
        $first_date = date("Y-m-d", strtotime("-2 days"));
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('date', 'LIKE', $first_date.'%')
            ->get();
        $sumary = 0;
        foreach($spendings as $spending){
            $sumary += (int)$spending->value;
        }
        return $sumary;
    }

    /*
     * Get icon for admin's report
     * */

    public function get_all_spendings_icon()
    {
        $value = $this->get_all_spendings_difference();
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

    /*
     * Get difference in percents from yesterday and day before
     * */

    public function get_all_spendings_difference()
    {
        $yesterday = $this->get_all_spendings_yesterday();
        $day_before = $this->get_all_spendings_day_before();

        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }

    }

    public function get_spendings_by_day()
    {

    }

    public function get_spendings_by_user_week($id)
    {
        if(empty($id)){
            return 'n/a';
        }

        $first_date = date("Y-m-d", strtotime("-6 days"));
        $last_date = date("Y-m-d", strtotime("today"));
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_date, $last_date])
            ->where('user_id', $id)
            ->get();
        $sumary = 0;
        foreach($spendings as $spending){
            $sumary += (int)$spending->value;
        }
        return $sumary;
    }

    public function get_spendings_by_user_previous_week($id)
    {
        if(empty($id)){
            return 'n/a';
        }

        $first_date = date("Y-m-d", strtotime("-2 weeks"));
        $last_date = date("Y-m-d", strtotime("-1 week"));
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_date, $last_date])
            ->where('user_id', $id)
            ->get();
        $sumary = 0;
        foreach($spendings as $spending){
            $sumary += (int)$spending->value;
        }
        return $sumary;
    }

    public function get_spendings_by_user_difference($id)
    {
        if(empty($id))
            return '';

        $yesterday = $this->get_spendings_by_user_week($id);
        $day_before = $this->get_spendings_by_user_previous_week($id);

        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }

    }


    public function get_spendings_by_user_icon($id)
    {
        if(empty($id))
            return '';

        $value = $this->get_spendings_by_user_difference($id);
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

}
