<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /* Simple pages for links in the footer */
    public function sitemap_page()
    {
        return view('pages.sitemap');
    }

    public function terms_page()
    {
        return view('pages.terms');
    }

    public function security_page()
    {
        return view('pages.security');
    }

    public function faq_page()
    {
        $faq = Page::where('area', 'like', 'faq')->first();
        $faq_list = json_decode($faq->content, true);
        return view('pages.faq')
            ->with('faq', $faq_list);
    }

    public function contact_page()
    {
        return view('pages.contact');
    }

    public function about_page()
    {
        return view('pages.about');
    }


    /*
     * FAQ search function
     * */

    public function faq_search(Request $request)
    {
        $faq = Page::where('area', 'like', 'faq')->first();
        $faq_list = json_decode($faq->content, true);
        $return = '';
        foreach(array_chunk($faq_list, 2) as $value) {
            $return .= '<div class="faq_column">';
            foreach ($value as $item) {
                $return .= '<div class="text-box">
                    <div class="text-box_head">
                        <span>' . $item["question"] . '</span>
                    </div>
                    <div class="text-box_body">
                        <p>' . $item["answer"] . '</p>
                    </div>
                    <div class="text-box_footer">
                        <a href="#" class="btn-read-more"><span>Read more</span><i class="icon-arrow-read"></i></a>
                    </div>
                </div>';
            }
            $return .= '</div>';
        }
        return $return;
    }
}
