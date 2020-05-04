<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Library\Dashboard\Balance\BalanceListChargesClass;
use App\Library\Dashboard\Balance\BalanceGraphClass;
use App\Library\BalanceGet;
use App\Library\CalendarClass;
use App\Library\Dashboard\Campaign\CampaignDisableClass;
use App\Library\Dashboard\Campaign\CampaignsFilterClass;
use App\Library\Dashboard\Campaign\CampaignsListClass;
use App\Library\Dashboard\Campaign\CampaignStatisticsClass;
use App\Library\Dashboard\Campaign\CampaignTrafficSourceClass;
use App\Library\ClicksGet;
use App\Library\Dashboard\Common\StatsBarsGraphClass;
use App\Library\Dashboard\Filters\CampaignFilterClass;
use App\Library\Dashboard\Filters\CampaignFilterValuesClass;
use App\Library\Dashboard\Filters\DailyOverviewFilterClass;
use App\Library\Dashboard\Filters\DailyOverviewFilterValuesClass;
use App\Library\Dashboard\Filters\TrafficFilterClass;
use App\Library\Dashboard\Filters\TrafficFilterValuesClass;
use App\Library\Dashboard\Main\DashboardStatisticsClass;
use App\Library\FilterCampaigns;
use App\Library\Filters\StatsListFilter;
use App\Library\ProductsGet;
use App\Library\CampaignCreate;
use App\Library\Dashboard\Campaign\CampaignCreateClass;
use App\Library\CampaignsGet;
use App\Library\SpendingsGet;
use App\Library\StatsList;
use App\Library\UserInfoGet;
use App\Library\AccountEdit;
use Illuminate\Http\Request;
use App\User;
use App\Library\Dashboard\Campaign\CampaignDailyOverviewClass;

class DashboardController extends Controller
{

    /* Functions
     for views pages on
     Users Dashboard */

    protected $user;

    public function __construct()
    {
        if(!$this->middleware(['role:customer'])){
            return true;
        } else {
            redirect()->route('login');
        }
        $this->user = auth()->user();

    }
    public function dashboard()
    {
        // Stats bars graph
        $StatsBarsGraphClass = new StatsBarsGraphClass();
        $stats_week = $StatsBarsGraphClass->get_stats_week();

        // Campaigns list
        $campaigns = new CampaignsListClass();
        $campaigns_list = $campaigns->active_campaigns();

        //Statistics information
        $DashboardStatisticsClass = new DashboardStatisticsClass();
        $stats_campaigns = $DashboardStatisticsClass->running_campaigns();
        $stats_spendings = $DashboardStatisticsClass->lw_spendings();
        $stats_clicks = $DashboardStatisticsClass->lw_clicks();

        // Balance
        $BalanceGraphClass = new BalanceGraphClass();
        $charges_graph_list = $BalanceGraphClass->graph_list();
        $charges_graph_last = $BalanceGraphClass->last_charge();
        $charges_graph_balance = number_format(auth()->user()->balance, 2, ',', ' ');

        //Filter values
        $CampaignFilterValuesClass = new CampaignFilterValuesClass();
        $campaign_filter = $CampaignFilterValuesClass->get_array();

        return view('dashboard.main')
            ->with('campaign_filter', $campaign_filter)
            ->with('charges_graph_list', $charges_graph_list)
            ->with('charges_graph_last', $charges_graph_last)
            ->with('charges_graph_balance', $charges_graph_balance)
            ->with('stats_week', $stats_week)
            ->with('campaigns_list', $campaigns_list)
            ->with('stats_clicks', $stats_clicks)
            ->with('stats_spendings', $stats_spendings)
            ->with('stats_campaigns', $stats_campaigns)
            ->with('campaings', $campaigns_list);
    }

    public function add_campaign()
    {
        $products_list = new ProductsGet();
        $products_list = $products_list->get_products_list();
        return view('dashboard.addcampaign')
            ->with('products_list', $products_list);
    }

    public function campaigns()
    {
        $user_id = auth()->user();
        $user_id = $user_id->id;

        //Filter values
        $CampaignFilterValuesClass = new CampaignFilterValuesClass();
        $campaign_filter = $CampaignFilterValuesClass->get_array();

        $campaigns = new CampaignsGet();
        $campaigns_list = $campaigns->get_campaigns_list_by_user_id($user_id, 1, 10, 0);
        return view('dashboard.campaigns')
            ->with('campaign_filter', $campaign_filter)
            ->with('campaigns', $campaigns_list);
    }

    public function campaign_detail($id)
    {
        $campaign = Campaign::find($id);
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if($campaign->user_id != $user_id){
            return abort(404);
        }

        $campaign_subproduct = mb_strimwidth($campaign->get_subproduct(), 0, 25, "...");
        $campaign_subproduct_full = $campaign->get_subproduct();
        $campaign_product = mb_strimwidth($campaign->get_product(), 0, 25, "...");
        $campaign_product_full = $campaign->get_product();
        $campaign_url = mb_strimwidth($campaign->url, 0, 30, "...");
        $campaign_url_full = $campaign->url;
        /* After refactoring */
        // Daily overview
        $CampaignDailyOverviewClass = new CampaignDailyOverviewClass();
        $daily_overview = $CampaignDailyOverviewClass->get_list($id);
        $DailyOverviewFilterValuesClass = new DailyOverviewFilterValuesClass();
        $daily_overview_values = $DailyOverviewFilterValuesClass->get_array($id);
        //Traffic source
        $traffic_source = new CampaignTrafficSourceClass($id);
        $traffic_source_list = $traffic_source->traffic_list_limited();
        //Traffic source filter
        $TrafficFilterValuesClass = new TrafficFilterValuesClass();
        $traffic_filter_values = $TrafficFilterValuesClass->get_array($id);

        // Stats bars graph
        $StatsBarsGraphClass = new StatsBarsGraphClass();
        $stats_week = $StatsBarsGraphClass->get_stats_week();

        // Campaigns list
        $campaigns = new CampaignsListClass();
        $campaigns_list = $campaigns->active_campaigns();

        // Campaign statistics
        $CampaignStatisticsClass = new CampaignStatisticsClass();
        $campaign_statistics = $CampaignStatisticsClass->get_statistics($id);


        return view('dashboard.campaign')
            ->with('campaigns_list', $campaigns_list)
            ->with('stats_week', $stats_week)
            ->with('statistics', $campaign_statistics)
            //
            ->with('daily_overview', $daily_overview)
            ->with('daily_overview_values', $daily_overview_values)
            //
            ->with('traffic_source', $traffic_source_list)
            ->with('traffic_filter_values', $traffic_filter_values)
            //
            ->with('product', $campaign_product)
            ->with('product_full', $campaign_product_full)
            ->with('subproduct', $campaign_subproduct)
            ->with('subproduct_full', $campaign_subproduct_full)
            ->with('url', $campaign_url)
            ->with('url_full', $campaign_url_full)
            ->with('campaign', $campaign);
    }

    public function campaign_traffic($id)
    {
        $campaign = Campaign::find($id);
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if($campaign->user_id != $user_id){
            return abort(404);
        }

        $campaign_subproduct = mb_strimwidth($campaign->get_subproduct(), 0, 25, "...");
        $campaign_subproduct_full = $campaign->get_subproduct();
        $campaign_product = mb_strimwidth($campaign->get_product(), 0, 25, "...");
        $campaign_product_full = $campaign->get_product();
        $campaign_url = mb_strimwidth($campaign->url, 0, 30, "...");
        $campaign_url_full = $campaign->url;
        //Traffic source filter
        $TrafficFilterValuesClass = new TrafficFilterValuesClass();
        $traffic_filter_values = $TrafficFilterValuesClass->get_array($id);
        //Traffic source
        $traffic_source = new CampaignTrafficSourceClass($id);
        $traffic_source_list = $traffic_source->traffic_list_limited();

        return view('dashboard.campaign_traffic')
            //
            ->with('traffic_source', $traffic_source_list)
            ->with('traffic_filter_values', $traffic_filter_values)
            ->with('product', $campaign_product)
            ->with('product_full', $campaign_product_full)
            ->with('subproduct', $campaign_subproduct)
            ->with('subproduct_full', $campaign_subproduct_full)
            ->with('url', $campaign_url)
            ->with('url_full', $campaign_url_full)
            ->with('campaign', $campaign);
    }

    public function calendar(Request $request)
    {
        $calendar = new CalendarClass();

        if(!isset($request->year) || !isset($request->month)){
            $year = date('Y');
            $month = date('m');
        } else {
            $year = $request->year;
            $month = $request->month;
        }
        $calendar_show = $calendar->calendar_show($year, $month);
        $next_month = $calendar->next_month($year, $month);
        $prev_month = $calendar->prev_month($year, $month);
        // Stats bars graph
        $StatsBarsGraphClass = new StatsBarsGraphClass();
        $stats_week = $StatsBarsGraphClass->get_stats_week();

        // Campaigns list
        $campaigns = new CampaignsListClass();
        $campaigns_list = $campaigns->active_campaigns();

        return view('dashboard.calendar')
            ->with('campaigns_list', $campaigns_list)
            ->with('stats_week', $stats_week)
            ->with('next_month', $next_month)
            ->with('prev_month', $prev_month)
            ->with('calendar', $calendar_show)->render();
    }

    /*
     * Show Balance page
     * */
    public function balance()
    {
        //List with charges
        $BalanceListChargesClass = new BalanceListChargesClass();
        $charges_list = $BalanceListChargesClass->run();
        // Balance graph
        $BalanceGraphClass = new BalanceGraphClass();
        $charges_graph_list = $BalanceGraphClass->graph_list();
        $charges_graph_last = $BalanceGraphClass->last_charge();
        $charges_graph_balance = number_format(auth()->user()->balance, 2, ',', ' ');
        // Spent box with bars


        return view('dashboard.balance')
            ->with('charges_list', $charges_list)
            ->with('charges_graph_list', $charges_graph_list)
            ->with('charges_graph_last', $charges_graph_last)
            ->with('charges_graph_balance', $charges_graph_balance);
    }

    public function charge()
    {
        return view('dashboard.charge');
    }

    public function account()
    {
        $user_info = new UserInfoGet();

        return view('dashboard.account')
            ->with('userinfo', $user_info->get_user_info());
    }

    public function campaign_added()
    {
        return view('dashboard.campaign-added');
    }

    public function add_campaign_process(Request $request)
    {
        $campaign = new CampaignCreateClass($request);
        return $campaign->run();
    }

    public function campaigns_filter(Request $request)
    {
//        $filter = new FilterCampaigns($request);
//        return $filter->filter_run();
    }

    public function account_edit(Request $request)
    {
        $account = new AccountEdit($request);
        return $account->run();
    }

    public function campaigns_disable(Request $request)
    {
        $campaign = new CampaignDisableClass($request);
        return $campaign->run();
    }

    public function campaign_edit($id)
    {
        $products = new ProductsGet();
        $products_list = $products->get_products_list();
        $campaign = Campaign::find($id);
        $user_id = auth()->user();
        $user_id = $user_id->id;
        $subproducts = [];
        $bid_type = '';

        if(!empty($campaign->subproduct_id)){
            $subproducts = $products->get_subproducts_list_by_product($campaign->product_id);
            $bid_type = $products->get_subproduct_cpc_type($campaign->subproduct_id);
        } else {
            $bid_type = $products->get_product_cpc_type($campaign->product_id);
        }

        if($campaign->user_id != $user_id){
            return abort(404);
        }
        return view('dashboard.edit-campaign')
            ->with('products_list', $products_list)
            ->with('subproducts', $subproducts)
            ->with('bid_type', $bid_type)
            ->with('campaign', $campaign);
    }

    /*
     * AJAX pagination and filter for traffic source
     * */
    public function campaigns_traffic(Request $request)
    {
        $id = $request->id;
        $traffic_source = new CampaignTrafficSourceClass($id);
        if(isset($request->pagination)){
            return $traffic_source->traffic_list_pagination($request);
        } else {
            return $traffic_source->traffic_list_filter($request);
        }
    }

    /*
     * Method for filtering form in stats
     * */
    public function filter_stats_list(Request $request)
    {
        $filter_stats = new StatsBarsGraphClass();
        return $filter_stats->get_request_data($request);
    }

    public function ajax_filter(Request $request)
    {
        if($request->action == 'campaigns_dashboard'){
            $filterClass = new CampaignFilterClass();
            return $filterClass->dashboard_filter($request);
        }
        if($request->action == 'traffic_source'){
            $filterClass = new TrafficFilterClass();
            return $filterClass->run_filter($request);
        }
        if($request->action == 'traffic_source_page'){
            $filterClass = new TrafficFilterClass();
            return $filterClass->run_filter_page($request);
        }
        if($request->action == 'daily_overview'){
            $filterClass = new DailyOverviewFilterClass();
            return $filterClass->run_filter($request);
        }
        if($request->action == 'campaign_page'){
            $filterClass = new CampaignFilterClass();
            return $filterClass->run_filter_page($request);
        }
    }
}