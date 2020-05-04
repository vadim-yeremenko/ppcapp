<?php

namespace App\Http\Controllers;

use App\Library\Admin\Ajax\AdminAjaxClass;
use App\Library\Admin\Ajax\AdminAjaxFiltersClass;
use App\Library\Admin\Filters\AdminProductsFilterValuesClass;
use App\Library\Admin\Filters\AdminProductSubproductFilterValuesClass;
use App\Library\Admin\Filters\AdminUsersFilterValuesClass;
use App\Library\Admin\Main\AdminStatisticsClass;
use App\Library\Admin\Products\AdminProductsGetClass;
use App\Library\Admin\Products\AdminProductsSubproductsClass;
use App\Library\Admin\Products\AdminUsersGetClass;
use App\Library\Admin\Users\AdminUsersListClass;
use App\Library\BalanceGet;
use App\Library\CampaignsGet;
use App\Library\ClicksGet;
use App\Library\EditPages;
use App\Library\FeedGet;
use App\Library\Filters\FilterProducts;
use App\Library\Filters\StatsListFilter;
use App\Library\ProductsCreate;
use App\Library\ProductsGet;
use App\Library\SpendingsGet;
use App\Library\StatsList;
use App\Library\UsersList;
use App\Campaign;
use App\Page;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    protected $products;
    protected $campaigns;
    protected $spendings;
    protected $clicks;

    public function __construct()
    {
        if(!$this->middleware(['role:administrator'])){
            return true;
        } else {
            redirect()->route('login');
        }
        $this->campaigns = new CampaignsGet();
        $this->products = new ProductsGet();
        $this->spendings = new SpendingsGet();
        $this->clicks = new ClicksGet();
    }

    public function editproduct_page($id)
    {
        $product = new ProductsGet();
        return view('admin.editproduct')
            ->with('product', $product->get_product_by_id($id))
            ->with('products', $product->get_products_list());
    }

    public function editsubproduct_page($id)
    {
        $product = new ProductsGet();
        return view('admin.editsubproduct')
            ->with('subproduct', $product->get_subproduct_by_id($id))
            ->with('products', $product->get_products_list());
    }

    public function dashboard_page()
    {
        $campaigns_list = $this->campaigns->get_running_campaigns();

        /* Users */
        $stats = new StatsList();
        $stats_week = $stats->get_stats_week('all');
        $get_max_clicks = $stats->get_max_clicks($stats_week);
        $get_min_clicks = $stats->get_min_clicks($stats_week);

        /*After refactoring */
        // Products list
        $AdminProductsGetClass = new AdminProductsGetClass();
        $products_list = $AdminProductsGetClass->get_products_list();
        // Users list
        $AdminUsersGetClass = new AdminUsersGetClass();
        $users_list = $AdminUsersGetClass->get_users_list();
        // Statistics
        $AdminStatisticsClass = new AdminStatisticsClass();
        $stats_campaigns = $AdminStatisticsClass->running_campaigns();
        $stats_spendings = $AdminStatisticsClass->lw_spendings();
        $stats_clicks = $AdminStatisticsClass->lw_clicks();

        // Products filter values
        $AdminProductsFilterValuesClass = new AdminProductsFilterValuesClass();
        $products_filter_values = $AdminProductsFilterValuesClass->get_array();

        // Products filter values
        $AdminUsersFilterValuesClass = new AdminUsersFilterValuesClass();
        $users_filter_values = $AdminUsersFilterValuesClass->get_array();


        return view('admin.dashboard')
            ->with('min_clicks_stats', $get_min_clicks)
            ->with('max_clicks_stats', $get_max_clicks)
            ->with('users_list', $users_list)
            ->with('products_list', $products_list)
            ->with('stats_week', $stats_week)
            ->with('campaigns_list', $campaigns_list)

            // Filters values
            ->with('product_filter_val', $products_filter_values)

            // Statistics
            ->with('stats_campaigns', $stats_campaigns)
            ->with('stats_spendings', $stats_spendings)
            ->with('stats_clicks', $stats_clicks);
    }

    public function product_subproducts($id)
    {
        $product_title = \App\Product::where('id', 'like', $id)->first()->name;
        $subproducts = $this->products->get_subproducts_by_product($id);
        return view('admin.product-subproducts')
            ->with('product_title', $product_title)
            ->with('product_id', $id)
            ->with('subproducts', $subproducts);
    }

    public function users_page()
    {
        $users_list = new AdminUsersListClass();
        $requests_count = $users_list->get_request_count();
        // Products filter values
        $AdminUsersFilterValuesClass = new AdminUsersFilterValuesClass();
        $users_filter_values = $AdminUsersFilterValuesClass->get_array();

        return view('admin.users')
            ->with('requests', $requests_count)
            ->with('user_filter_val', $users_filter_values)
            ->with('users_list', $users_list->active_users_list());
    }

    public function users_requests_page()
    {
        $users_list = new UsersList;
        return view('admin.users')
            ->with('users_list', $users_list->get_active_users_list());
    }

    public function products_list_page()
    {
        return view('admin.products-list')
            ->with('products_list', $this->products->get_list_for_list());
    }

    public function products_page()
    {
        $poducts_count = $this->products->get_count_products(); /* Get products count */
        $subpoducts_count = $this->products->get_count_subproducts(); /* Get subproducts count */
        $subpoducts_campaigns_count = $this->products->get_count_subproducts(); /* Get subproducts count */
        $list = $this->products->get_list();

        // After refactoring
        $AdminProductsSubproductsClass = new AdminProductsSubproductsClass();
        $products_array = $AdminProductsSubproductsClass->make_array();
        // Filter values
        $AdminProductSubproductFilterValuesClass = new AdminProductSubproductFilterValuesClass();
        $filter_value = $AdminProductSubproductFilterValuesClass->get_array();

        return view('admin.products')
            ->with('filter_value', $filter_value)
            ->with('list', $list)
            ->with('products_count', $poducts_count)
            ->with('subproducts_count', $subpoducts_count)
            ->with('products_array', $products_array);
    }

    public function user_page_campaigns_pagination($id)
    {
        return '';
    }

    public function user_request_accept(Request $request)
    {
        $request_accept = new UsersList;
        return $request_accept->accept_request($request);
    }

    public function user_request_decline(Request $request)
    {
        $request_accept = new UsersList;
        return $request_accept->user_request_decline($request);
    }

    public function balance_page()
    {
        $balance = new BalanceGet();
        $clicks = new ClicksGet();
        $users = new UsersList();

        /* Spendings */
        $all_users_spendings = number_format($balance->get_spendings_for_week(),2);
        $all_users_spendings_changing = $balance->get_spendings_difference();
        $all_users_spendings_changing_icon = $balance->get_spendings_change();
        $all_users_spendings_graph = $balance->users_spendings_graph();

        $all_clicks_last_week = $clicks->get_all_clicks_last_week();
        $average_cpc = $balance->get_average_cpc();

        /* Charges */

        $all_users_charges = number_format($balance->get_charges_for_week(), 2);
        $all_users_charges_changing = $balance->get_charges_difference();
        $all_users_charges_changing_icon = $balance->get_charges_change();
        $all_users_charges_graph = $balance->users_charges_graph();

        /* Users */
        $all_users = $users->get_active_users_list();

        /* After refactoring */
        // Users list class
        $users_list = new AdminUsersListClass();
        $requests_count = $users_list->get_request_count();
        // Users filter values
        $AdminUsersFilterValuesClass = new AdminUsersFilterValuesClass();
        $users_filter_values = $AdminUsersFilterValuesClass->get_array();

        return view('admin.balance')
            ->with('users', $all_users)
            ->with('all_users_spendings', $all_users_spendings)
            ->with('all_users_spendings_changing', $all_users_spendings_changing)
            ->with('all_users_spendings_changing_icon', $all_users_spendings_changing_icon)
            ->with('all_users_spendings_graph', $all_users_spendings_graph)
            ->with('all_clicks_last_week', $all_clicks_last_week)
            ->with('average_cpc', $average_cpc)
            ->with('all_users_charges', $all_users_charges)
            ->with('all_users_charges_changing', $all_users_charges_changing)
            ->with('all_users_charges_changing_icon', $all_users_charges_changing_icon)
            ->with('all_users_charges_graph', $all_users_charges_graph)
            // After ref
            ->with('user_filter_val', $users_filter_values)
            ->with('users_list', $users_list->active_users_list());
    }

    public function cpc_page()
    {

        $AdminProductsSubproductsClass = new AdminProductsSubproductsClass();
        $products_array = $AdminProductsSubproductsClass->make_array();
        //dd($products_array);
        return view('admin.cpc')
            ->with('products_array', $products_array);
    }

    public function feed_page()
    {
        $feed = new FeedGet();
        $feed_list = $feed->get_list();
        return view('admin.feed')
            ->with('feed', $feed_list);
    }

    public function addproduct_page()
    {
        $products = \App\Product::orderBy('id', 'asc')->get();
        return view('admin.addproduct', compact('products'));
    }

    public function user_page($id)
    {
        $users_list = new UsersList;
        $user = $users_list->get_user_by_id($id);
        $campaigns = new CampaignsGet();
        $campaigns = $campaigns->get_campaigns_list_by_user_id($id, null, 0,0);

        /* All for stats box */
        $stats = new StatsList();
        $stats_week = $stats->get_stats_week($id);
        $campaigns_list = $this->campaigns->get_running_campaigns();
        $get_max_clicks = $stats->get_max_clicks($stats_week);
        $get_min_clicks = $stats->get_min_clicks($stats_week);

        /* All for user's balance box */
        $balance_info = $users_list->get_users_balance($id);
        $balance_week = $users_list->get_users_week_balance_difference($id);
        $balance_week_class = $users_list->get_users_week_balance_class($id);
        $user_clicks = $users_list->get_clicks_by_user($id);
        $user_average_clicks = $users_list->get_user_average_clicks($id);

        return view('admin.user')
            ->with('min_clicks_stats', $get_min_clicks)
            ->with('max_clicks_stats', $get_max_clicks)
            ->with('stats_week', $stats_week)
            ->with('campaigns_list', $campaigns_list)
            ->with('user', $user)
            ->with('balance', $balance_info)
            ->with('balance_week', $balance_week)
            ->with('balance_week_class', $balance_week_class)
            ->with('user_clicks', $user_clicks)
            ->with('user_average_clicks', $user_average_clicks)
            ->with('campaigns', $campaigns);
    }

    public function campaigns_page($id)
    {
        $campaigns = Campaign::find($id);
        return view('admin.campaign', compact($campaigns));
    }
    /*
     * Method for filtering by user's type in User's page
     * */
    public function product_add(Request $request)
    {
        $product = new ProductsCreate($request);
        return $product->run();
    }

    /*
     * Method for filtering by user's type in User's page
     * */
    public function users_type(Request $request)
    {
        $users_list = new AdminUsersListClass();
        return $users_list->get_users_list_by_type($request);
    }

    /*
     * Method for filtering form in stats
     * */
    public function filter_stats_list(Request $request)
    {
        $filter_stats = new StatsListFilter();
        return $filter_stats->get_request_data($request);
    }

    /*
     * Method for filtering users
     * */
    public function filter_users_list(Request $request)
    {
        //$users = new UsersList();
        return $request;
    }

    /*
    * Method for edit main page
    * */
    public function edit_pages()
    {
        return view('admin.admin-pages');
    }

    /*
    * Method for edit faq
    * */
    public function edit_pages_faq()
    {
        $faq = Page::where('area', 'like', 'faq')->first();
        $pagetitle = $faq->title;
        if(!empty($faq->content)){
            $faq_list = json_decode($faq->content);
        } else {
            $faq_list = [];
        }

        return view('admin.edit.edit-faq')
            ->with('faq_list', $faq_list)
            ->with('pagetitle', $pagetitle);
    }

    /*
    * Method for edit faq
    * */
    public function edit_pages_sitemap()
    {
        return view('admin.edit.edit-sitemap');
    }

    /*
    * Method for edit security
    * */
    public function edit_pages_security()
    {
        return view('admin.edit.edit-security');
    }

    /*
    * Method for edit terms
    * */
    public function edit_pages_terms()
    {
        return view('admin.edit.edit-privacy');
    }

    /*
    * Method for edit add campaign form
    * */
    public function edit_pages_campaign()
    {
        return view('admin.edit.edit-addcampaign');
    }

    /*
    * Method for edit add product form
    * */
    public function edit_pages_product()
    {
        return view('admin.edit.edit-addproduct');
    }


    /*
    * Method for edit registration form
    * */
    public function edit_pages_registration()
    {
        return view('admin.edit.edit-registration');
    }

    /*
     * Method for filter
     * and pagination for products list
     * */

    public function filter_products()
    {

    }

    /*
     * Method for filter
     * and pagination for subproducts list
     * */

    public function filter_subproducts(Request $request, $id)
    {
        $filter = new FilterProducts;
        return $filter->run_subproducts_filter($request, $id);
    }

    /*
     * Method for edit faq
     *
     * */
    public function edit_faq_ajax(Request $request)
    {
        $edit = new EditPages;
        if($request->title){
            /* If edit pagetitle */
            return $edit->edit_faq_title_run($request);
        } else if($request->add) {
            /* If add new item */
            return $edit->add_faq_run($request);
        } else if($request->delete == '1') {
            /* If edit old item */
            return $edit->remove_faq_run($request);
        } else {
            /* If edit old item */
            return $edit->edit_faq_run($request);
        }
    }

    /* Ajax method for forms, switchers (tabs on dashboard) and other (non-filter, non-pagination) functions*/
    public function ajax_requests(Request $request)
    {
        $AdminAjaxClass = new AdminAjaxClass($request);
        return $AdminAjaxClass->run_ajax($request);
    }

    /* Ajax method for filter and pagination functions*/
    public function ajax_filters(Request $request)
    {
        $AdminAjaxFiltersClass = new AdminAjaxFiltersClass($request);
        return $AdminAjaxFiltersClass->run_ajax($request);
    }
}