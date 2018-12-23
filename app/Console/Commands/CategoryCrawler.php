<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostModel;

class CategoryCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dom = file_get_html('su-kien.htm', 'https://dantri.com.vn/');
        $a = $dom->find('#listcheckepl div .mr1 h2 a');
        $categories = array();
        foreach ($a as $key => $value){
            $category['title'] = $value->innertext;
            $category['status'] = '2';
            $category['author'] = 1;
            $category['category_id'] = 1;
            $category['slug'] = $value->href;

            $get_link = file_get_html($category['slug'],'https://dantri.com.vn/');
            $b = $get_link->find('#divNewsContent');
            foreach ($b as $keys => $item){
                $category['content'] = $item->innertext;
            }
            $categories[] = $category;
        }
        foreach ($categories as $post){
            PostModel::create($post);
        }

        for ($i = 2; $i <= 10; $i++)
        {
            $dom = file_get_html('su-kien/trang-'.$i.'.htm', 'https://dantri.com.vn/');
            $a = $dom->find('#listcheckepl div .mr1 h2 a');
            $categories = array();
            foreach ($a as $key => $value){
                $category['title'] = $value->innertext;
                $category['status'] = '2';
                $category['author'] = 1;
                $category['category_id'] = 1;
                $category['slug'] = $value->href;

                $get_link = file_get_html($category['slug'],'https://dantri.com.vn/');
                $b = $get_link->find('#divNewsContent');
                foreach ($b as $keys => $item){
                    $category['content'] = $item->innertext;
                }
                $categories[] = $category;
            }
            foreach ($categories as $post){
                PostModel::create($post);
            }
        }

        echo "<pre>";
        print_r($categories);
        echo "</pre>";
    }
}
