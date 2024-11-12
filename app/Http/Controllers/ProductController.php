<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::all();
        $products = Product::searchProducts($request);

        return view('index', compact('products', 'companies'))
            ->with('page_id', $request->page_id)
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('create')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Product::createProduct($request);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error(__('messages.error_during_registration') . ' ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.error_during_registration'))->withInput();
        }
    
        return redirect()->route('products.index')->with("success", __('messages.registration_success'));
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $companies = Company::all();
        return view('show', compact('product', 'companies'))
            ->with('page_id', request()->page_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                Product::updateProduct($request, $product);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error(__('messages.error_during_registration') . ' ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.error_during_registration'))->withInput();
        }

        return redirect()->route('products.index')->with("success", __('messages.update_success'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                Product::deleteProduct($product);
            });
        } catch (\Exception $e) {
            Log::error(__('messages.error_during_deletion') . ' ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', __('messages.error_during_deletion'));
        }

        return redirect()->route('products.index')->with("success", $product->name . __('messages.deletion_success'));
    }
}
