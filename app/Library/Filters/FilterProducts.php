<?php



namespace App\Library\Filters;

use App\Product;
use App\Subproduct;

class FilterProducts
{
    public function __construct()
    {

    }

    public function run_subproducts_filter($request, $id = 0)
    {
        $result = array();

        if($id == 0){
            return;
        } else {
            $sorting = $request->sorting;
            $limit = ((int)$request->pagination + 1) * 5;

            $campaigns = $this->delimiter($request->campaigns);
            $campaigns_min = $campaigns[0];
            $campaigns_max = $campaigns[1];

            $lw_spendings = $this->delimiter($request->last_week_spendings);
            $lw_spendings_min = $lw_spendings[0];
            $lw_spendings_max = $lw_spendings[1];

            $total_spendings = $this->delimiter($request->total_spendings);
            $total_spendings_min = $total_spendings[0];
            $total_spendings_max = $total_spendings[1];

            /*
             * Count all subproducts for this product
             *
             * */
            $subproducts_count = Subproduct::orderBy('id', 'asc')
                ->where('product_id', 'like', $id)
                ->count();

            $subproducts = Subproduct::orderBy('id', 'asc')
                ->where('product_id', 'like', $id)
                ->whereHas('campaigns_count', function ($query) use ($total_spendings) {
                    $query->where('value', '>', 1);
                })
                ->limit($limit)
                ->get();

            $result['pagination'] = count($subproducts);
            $result['count'] = $subproducts_count;

            if($subproducts_count <= $limit){
                $result['pagination_end'] = true;
            } else{
                $result['pagination_end'] = false;
            }

            $result['html'] = view('admin.partials.subproducts')
                ->with('subproducts', $subproducts)
                ->render();

            return response()->json($result);

        }

    }

    private function delimiter($value)
    {
        $array = explode(';', $value);
        return $array;
    }

    private function sorting_request($request)
    {
        return $request;
    }
}