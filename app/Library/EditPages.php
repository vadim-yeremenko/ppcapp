<?php

namespace App\Library;


use App\Page;
use function MongoDB\BSON\toJSON;

class EditPages
{
    public function __construct()
    {

    }

    /*
     * =====================================================
     * =================       FAQ       ===================
     * =====================================================
     * */

    public function edit_faq_title_run($request)
    {
        $page = Page::where('area', 'like', 'faq')->count();

        if($page > 0) {
            $page = Page::where('area', 'like', 'faq')->first();
            $page->title = $request->title;
            $page->save();
            return response()->json(array('success' => 'edited'));
        } else {
            $page = new Page;
            $page->title = $request->title;
            $page->area = 'faq';
            $page->save();
            return response()->json(array('success' => 'added'));
        }
    }

    public function add_faq_run($request)
    {
        $page = Page::where('area', 'like', 'faq')->count();

        if($page > 0) {
            $page = Page::where('area', 'like', 'faq')->first();
        } else {
            $page = new Page;
        }

        $content = $page->content;

        if(!empty($content)){
            $content_array = json_decode($content, true);
        } else {
            $content_array = array();
        }

        $item[] = array(
            'id' => count($content_array) + 1,
            'question' => $request->question,
            'answer' => $request->answer,
        );

        $content_array = array_merge($content_array, $item);

        $page->content = json_encode($content_array);
        $page->save();
        return response()->json(array('success' => 'added'));
    }

    public function edit_faq_run($request)
    {
        $page = Page::where('area', 'like', 'faq')->first();

        $content = $page->content;

        if(!empty($content)){
            $content_array = json_decode($content, true);
        } else {
            $content_array = array();
        }

        $item[count($content_array) + 1] = array(
            'question' => $request->question,
            'answer' => $request->answer,
        );

        $content_array = array_merge($content_array, $item);

        $page->content = json_encode($content_array);
        $page->save();
        return response()->json(array('success' => 'added'));
    }

    public function remove_faq_run($request)
    {
        $page = Page::where('area', 'like', 'faq')->first();

        $id = $request->faq;

        $content = $page->content;

        if(!empty($content)){
            $content_array = json_decode($content, true);

            foreach($content_array as $key=>$item)
            {
                if($key == $id){
                    unset($content_array[$key]);
                }
            }
        } else {
            $content_array = array();
        }

        $content_array = array_values($content_array);

        $page->content = json_encode($content_array);
        $page->save();
        return response()->json(array('success' => $id));
    }

    /*
     * ==================================================================
     * =================       Table of service       ===================
     * ==================================================================
     * */

    public function edit_table_of_service()
    {

    }
}