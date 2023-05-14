<?php

namespace App\Http\Controllers\Crowl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Code;
use App\Models\Product;
use App\Models\Language;
use App\Models\Brand;
use App\Models\BrandLocale;
use App\Models\Store;
use App\Models\Category;
use App\Models\CategoryLocale;
use App\Models\Color;
use App\Models\ProductColorMeta;
use App\Models\ProductLocale;
use App\Models\StoreMenu;
use Image;
use Excel;
use App\Imports\ProductImport;
use App\General;
use Illuminate\Validation\Rule;
use App\Models\ProductSize;
use App\Models\ProductSizeLocale;
use App\Models\ProductOption;
use App\Models\ProductOptionLocale;
use App\Models\OptionItem;
use App\Models\OptionItemLocale;
use App\Models\ProductGurantee;
use App\Models\ProductGuranteeLocale;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\CategoryDepartment;
use voku\helper\HtmlDomParser;


class IkeaController extends Controller
{
    public function index()
    {
        $items =  Code::on('mysql2')->where('id','>',9915)->get();

        $store_id =  20;
        foreach ($items as $item) {
            $cats =  json_decode($item->categories);
            $index  =  count($cats) -1;
            unset($cats[$index]) ;

            $cats_ar =  json_decode($item->categories_ar);
            $index_ar  =  count($cats_ar) -1;
            unset($cats_ar[$index]) ;
            $category_id =  NULL;
            foreach ($cats as $key=>$cat) {
                $name =  str_replace('&amp;', 'and', $cat);
                $slug =  \Str::slug($name);
                $category =  Category::where('slug',$slug)->first();
                if (empty($category)) {
                    $category =  new Category;
                    $category->slug = $slug;
                    $category->parent_id = $category_id;
                    $category->save();

                    if ($key == 0) {
                        $dep =  new CategoryDepartment;
                        $dep->category_id =  $category->id;
                        $dep->department_id = 3;
                        $dep->save();
                    }

                    $locale         = new CategoryLocale;
                    $locale->locale = 'en';
                    $locale->name   =  $cat;
                    $locale->category_id =  $category->id;
                    $locale->save();

                    $locale         = new CategoryLocale;
                    $locale->locale = 'ar';
                    $locale->name   =  (array_key_exists($key, $cats_ar))?$cats_ar[$key]:' ';
                    $locale->category_id =  $category->id;
                    $locale->save();
                }
                $category_id =  $category->id;
            }
            $data = Product::where('ikea_id',$item->ikea_id)->first();
            if (empty($data)) {
                $data =  new Product;
                $data->slug  =  \Str::slug(General::char_change($item->name));
                $data->price =  $item->price;
                $data->order_gno =  'ON'.mt_rand(1111111,9999999); 
                $data->partner_sku =  $item->ikea_id;
                $data->ikea_id    =  $item->ikea_id;
                $data->store_id =  20;
                $data->category_id =  $category_id;
                $data->save();

                $locale          =  new ProductLocale;
                $locale->locale  =  'en';
                $locale->name    =   General::char_change($item->name);
                $locale->text    =   $item->text;
                $locale->product_id =  $data->id;
                $locale->save();

                $locale          =  new ProductLocale;
                $locale->locale  =  'ar';
                $locale->name    =   $item->name_ar;
                $locale->text    =   $item->text_ar;
                $locale->product_id =  $data->id;
                $locale->save();

                $imgs = [];
                $metas =  json_decode($item->imgs);
                foreach ($metas as $key=>$img) {
                    $item_img =  explode('?', $img) ;
                    $image = Image::make($item_img[0]) ;
                    $filename =  'uploads/ikea/'.$key.'_'.$data->id.'_'.time().'.jpg';
                    $image->save($filename);
                    array_push($imgs,$filename);
                }

                $meta =  new ProductColorMeta;
                $meta->color_id =  1;
                $meta->image = json_encode($imgs);
                $meta->product_id = $data->id;
                $meta->save();
                echo $data->id.'_new';
            }else{
                echo $data->id.'_exists';
            }
            
        }
    }
    public function meta()
    {
        $items =  Code::on('mysql2')->get();

        $store_id =  20;
        foreach ($items as $item) {
            
            $data = Product::where('ikea_id',$item->ikea_id)->first();
            if ($data) {
                $imgs = [];
                $metas =  json_decode($item->imgs);
                foreach ($metas as $key=>$img) {
                    $item_img =  explode('?', $img) ;
                    $image = Image::make($item_img[0]) ;
                    $filename =  'uploads/ikea/'.$key.'_'.$data->id.'_'.time().'.jpg';
                    $image->save($filename);
                    array_push($imgs,$filename);
                }
                $meta = ProductColorMeta::where('product_id',$data->id)->first();
                if (empty($meta)) {
                    $meta =  new ProductColorMeta;
                }
                $meta->color_id =  1;
                $meta->image = json_encode($imgs);
                $meta->product_id = $data->id;
                $meta->save();
                echo $data->id.'_meta';
            }
        }
    }
}
