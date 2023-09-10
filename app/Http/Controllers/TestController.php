<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProperty;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Meilisearch\Client;
use Meilisearch\Endpoints\Indexes;
use Meilisearch\Meilisearch;
use Modules\Cart\Facade\Cart;
use function Clue\StreamFilter\fun;

class TestController extends Controller
{
    public function index()
    {
        //dd(date('Y/m/d H:i:s', 1694191676));
        $products = Product::query()->where('is_special' , 1)->get();
        return view('test', compact('products'));
    }

    public function comments()
    {
        //auth()->logout();
        //auth()->loginUsingId(1);
        //dd(session()->all());
        /*Cart::put([
             'id' => time(),
             'product_id' => 10,
             'color_id' => 6,
             'number' => 1,
         ]);*/
        //$attributesNumber = $product->category()->with('attributes')->get()->pluck('attributes')->flatten()->count();


        //$products = Product::query()->leftJoin('brands', 'products.brand_id', '=', 'brands.id')->get();


        /*$searchedProducts = Product::search($searchedWord, function ($meilisearch, $query, $options) {
            $options['showRankingScore'] = true;
            $options['showMatchesPosition'] = true;
            $options['attributesToSearchOn'] = ['category'];
            return $meilisearch->search($query, $options);
        });*/
    }
}

/*public function doSearch(Request $request, Category $category)
{
    if (isset($category)) {
        $categories = $category->allChildren();
        $categoriesID = $categories->pluck('id')->toArray();
        $query = Product::query()->whereIn('category_id', $categoriesID);
    }

    $allProducts = collect();

    if ($request->brands) {
        $products = $query->whereIn('brand_id', $request->brands)->get();
        $allProducts = $allProducts->merge($products);
    }

    if ($request->colors) {
        $products = $query->whereHas('colors', function ($query) use ($request) {
            $query->whereIn('id', $request->colors);
        })->get();
        $allProducts = $allProducts->merge($products);
    }

    $priceRange = explode(';', $request['price-slider']);
    $minPrice = $priceRange[0];
    $maxPrice = $priceRange[1];

    $products = $query->whereBetween('price', [$minPrice, $maxPrice])->get();
    $allProducts = $allProducts->merge($products);

    $products = $this->setFilters($query, $request->filter, $request['order-by']);
    $allProducts = $allProducts->merge($products);

    if ($request->available == 1) {
        $products = $query->where('inventory', '>', 0)->get();
        $allProducts = $allProducts->merge($products);
    }

    $productAttrVal = $this->productAttributeValue();
    foreach ($products as $productKey => $product) {
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'attr-')) {
                @$attributeID = explode('-', $key)[1];
                $valuesID = $value;
                @$thisProductAttrVal = $productAttrVal[$product->id][$attributeID];
                if (!in_array($thisProductAttrVal, $valuesID)) {
                    unset($products[$productKey]);
                }
            }
        }
    }

    foreach ($allProducts as $product) {
        $product->load(['colors', 'comments' => function ($query) use ($product) {
            $commentsCount = $query->count();
            if ($commentsCount > 0) {
                $product->score = productScore($product->id);
            }
        }, 'attributes' => function ($query) {
            $query->where('filter', 1)->orderBy('id', 'desc')->take(6);
        }]);

        if ($product->attributes) {
            foreach ($product->attributes as $attribute) {
                $attribute->value = $attribute->pivot->value->value;
            }
        }
    }

    $productsNum = $products->count();
    $perPage = $request['per-page'];
    $page = $request['currentPage'];
    $offset = ($page - 1) * $perPage;
    $perPageProducts = $products->slice($offset, $perPage);

    $pagesNum = ceil($productsNum / $perPage);

    return [$perPageProducts, $pagesNum];
}*/
