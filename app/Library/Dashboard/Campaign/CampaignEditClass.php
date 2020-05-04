<?php

/*
 * Campaign will be edited using this class
 *
 * */
namespace App\Library\Dashboard\Campaign;
use Illuminate\Support\Facades\Validator;

class CampaignEditClass
{
    protected $request;
    protected $cpc_values;
    protected $result;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validation()
    {
        $data = $this->request;

        if($this->request->sub_product){
            $check_type = 'sub_product';
            $check_id = $this->request->sub_product;
        } else {
            $check_type = 'product';
            $check_id = $this->request->product;
        }

        $rules = [
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'date' => 'required|max:255',
            'product' => 'required|max:255',
        ];

        if(isset($this->request->product)){
            $cpc = $this->check_min_max_cpc($check_id, $check_type);

            if($cpc['type'] == 'fixed'){
                $fixedmaxcpc = $cpc['fixed']+1;
                $rules['cpc'] = 'required|numeric|min:'.$cpc['fixed'].'|max:'.$fixedmaxcpc;
            } else {
                $rules['cpc'] = 'required|numeric|min:'.$cpc['min'].'|max:'.$cpc['max'];
            }
        }

        $validator = Validator::make($data->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        return $this->process();
    }

    public function process()
    {
        $data = $this->request;
        $this->add_campaign($data);
        /* Success result */
        $returnHTML = view('dashboard.campaign-added')->with('campaign', $this->result)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function add_campaign($data)
    {
        $campaign_info = array();
        //Prepare data's before adding to DB
        $date = date("Y-m-d", strtotime($data->date));
        $user = auth()->user();
        $campaign = new \App\Campaign;
        $campaign->title = $data->title;
        $campaign->user_id = $user->id;
        $campaign->url = $data->url;
        $campaign->cpc = $data->cpc;
        $campaign->date = $date;
        $campaign->product = $data->product;
        $campaign->subproduct = $data->sub_product;
        $campaign->save();

        $starting_day = date("l m/d/Y", strtotime($date));
        $cpc = $campaign->cpc/100;

        $img = url('images/image-placeholder.png');
        $subproduct_title = '';
        $product = \App\Product::orderBy('id', 'asc')
            ->where('id', '=', $data->product)
            ->first();
        $img = $product->image;
        $product_title = $product->name;
        if($data->sub_product){
            $subproduct = \App\Subproduct::orderBy('id', 'asc')
                ->where('id', '=', $data->sub_product)
                ->first();
            $img = $subproduct->image;
            $subproduct_title = $subproduct->name;
        }

        $this->result['img'] = $img;
        $this->result['id'] = $campaign->id;
        $this->result['title'] = $campaign->title;
        $this->result['starting'] = $starting_day;
        $this->result['product'] = $product_title;
        $this->result['subproduct'] = $subproduct_title;
        $this->result['cpc'] = $cpc;
        $this->result['url'] = $campaign->url;
    }

    public function check_min_max_cpc($id, $type)
    {
        $cpc_values = array();
        if(empty($id)){
            return $cpc_values;
        } else {
            if($type == 'product'){
                $product = \App\Product::orderBy('id', 'asc')
                    ->where('id', '=', $id)
                    ->first();
                if(isset($product->fixcpc)){
                    $cpc_values['type'] = 'fixed';
                    $cpc_values['fixed'] = $product->fixcpc;
                } else {
                    $cpc_values['type'] = 'range';
                    $cpc_values['min'] = $product->mincpc;
                    $cpc_values['max'] = $product->maxcpc;
                }
            } else {
                $subproduct = \App\Subproduct::orderBy('id', 'asc')
                    ->where('id', '=', $id)
                    ->first();
                if(isset($subproduct->fixcpc)){
                    $cpc_values['type'] = 'fixed';
                    $cpc_values['fixed'] = $subproduct->fixcpc;
                } else {
                    $cpc_values['type'] = 'range';
                    $cpc_values['min'] = $subproduct->mincpc;
                    $cpc_values['max'] = $subproduct->maxcpc;
                }
            }
            return $cpc_values;
        }
    }

    public function change_subproducts()
    {
        $subproducts_list = \App\Subproduct::orderBy('id', 'asc')
            ->where('product_id', '=', $this->request->product)
            ->get();
        return response()->json(['subproducts'=>$subproducts_list]);
    }

    public function change_bid()
    {
        if(($this->request->product_type) == 'product'){
            return $this->change_bid_product();
        } else {
            return  $this->change_bid_subproduct();
        }
    }

    public function change_bid_product()
    {
        $bid = array();
        $product_id = $this->request->product;
        $products_list = \App\Product::orderBy('id', 'asc')
            ->where('id', '=', $product_id)
            ->first();

        $bid['mincpc'] = $products_list->mincpc;
        $bid['maxcpc'] = $products_list->maxcpc;
        $bid['fixcpc'] = $products_list->fixcpc;

        return response()->json(['bid'=>$bid]);
    }

    public function change_bid_subproduct()
    {
        $bid = array();
        $subproduct_id = $this->request->sub_product;
        $subproducts_list = \App\Subproduct::orderBy('id', 'asc')
            ->where('id', '=', $subproduct_id)
            ->first();
        $bid['maxcpc'] = $subproducts_list->maxcpc;
        $bid['mincpc'] = $subproducts_list->mincpc;
        $bid['fixcpc'] = $subproducts_list->fixcpc;

        return response()->json(['bid'=>$bid]);
    }

    public function run()
    {
        if(isset($this->request->product_updated)){
            return $this->change_subproducts();
        } else if(isset($this->request->bid_updated)) {
            return $this->change_bid();
        }else {
            return $this->validation();
        }
    }
}