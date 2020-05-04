<?php

namespace App\Library;

use App\Product;
use App\Subproduct;
use http\Env\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductsCreate
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validation()
    {
        $data = $this->request;

        $min_maxcpc = (int)$data->mincpc + 1;
        $max_mincpc = (int)$data->maxcpc;
        $cpc_type = (int)$data->cpc_type;
        $rules = [
            'title' => 'required|max:255',
            'is_sub' => 'required',
            'parent_product' => 'required_if:is_sub,yes',
            'description' => 'required',
            'cpc_type' => 'required',
            'url' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($data->all(), $rules);

        $validator->sometimes('mincpc', 'required|numeric|max:'.$max_mincpc, function($input)
        {
            return $input->cpc_type == 'range';
        });

        $validator->sometimes('maxcpc', 'required|numeric|min:'.$min_maxcpc, function($input)
        {
            return $input->cpc_type == 'range';
        });

        $validator->sometimes('singlecpc', 'required|numeric', function($input)
        {
            return $input->cpc_type == 'singular';
        });

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $this->process();

        $returnHTML = view('admin.product-added')->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function process()
    {
        $data = $this->request;
        if($data->is_sub == 'yes'){
            $this->add_subproduct($data);
        } else {
            $this->add_product($data);
        }

    }

    public function add_product($data)
    {
        //Prepare data's before adding to DB
        $mincpc = $data->mincpc;
        $maxcpc = $data->maxcpc;
        $fixedcpc = $data->singlecpc;

        $image = $data->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/products'), $new_name);

        $product = new \App\Product;
        $product->name = $data->title;
        $product->description = $data->description;
        $product->mincpc = $mincpc;
        $product->maxcpc = $maxcpc;
        $product->fixcpc = $fixedcpc;
        $product->url = $data->url;
        $product->image = url('img/products').'/'.$new_name;
        $product->save();
    }

    public function add_subproduct($data)
    {
        $mincpc = $data->mincpc;
        $maxcpc = $data->maxcpc;
        $fixedcpc = $data->singlecpc;

        $image = $data->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/products'), $new_name);

        $subproduct = new \App\Subproduct();
        $subproduct->name = $data->title;
        $subproduct->description = $data->description;
        $subproduct->mincpc = $mincpc;
        $subproduct->maxcpc = $maxcpc;
        $subproduct->fixcpc = $fixedcpc;
        $subproduct->fixcpc = $fixedcpc;
        $subproduct->image = url('img/products').'/'.$new_name;

        $product = \App\Product::find($data->parent_product);
        $product->sub_product()->save($subproduct);
    }

    public function run()
    {
        return $this->validation();
    }
}