<?php

namespace Modules\Cart\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Facade\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('cart::Frontend/index');
    }

    /**
     * Update the specified resource in storage.
     *
     *
     *
     */
    public function update($id, $number)
    {
        $product = Cart::get($id);
        if ($product) {
            if ($product['product']['inventory'] >= $number) {
                Cart::update($id, ['number' => $number]);

                $products = $this->getProducts();

                return json_encode($products);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cart::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cart::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cart::edit');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return string
     */
    public function destroy($id)
    {
        Cart::delete($id);
        $products = $this->getProducts();
        return json_encode($products);
    }

    protected function getProducts()
    {
        $cart = Cart::all();

        $allProductsPrice = $cart->sum(function ($item) {
            return $item['product']['price'] * $item['number'];
        });

        $allProductsDiscount = $cart->sum(function ($item) {
            return ($item['product']['price'] - ($item['product']['discount'] * $item['product']['price']) / 100) * $item['number'];
        });

        return [$cart, $allProductsPrice, $allProductsDiscount];
    }
}
