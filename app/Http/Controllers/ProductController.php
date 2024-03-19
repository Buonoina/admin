<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 全部の処理共通で必要 (会社情報)
        // 検索したとき($request 内に search があった場合)
            $search = $request->input('search');
            $company = $request->input('company'); 


            $companies = Company::query()->get();

            $product_query = Product::query();

            // 商品検索条件を追加
            if($request->search){
            $product_query -> where('name', 'LIKE', "%{$search}%");
             }

             if($request->company){
            $product_query -> where('company_id', 'LIKE', "%{$company}%");
             }

            // 商品一覧を 10 ごとに作成
            $products = $product_query -> orderBy('company_id', 'asc') ->paginate(10);

            // products と companies を view に渡す。
            return view('index', compact('products', 'companies'));      

        // 検索していない場合
        $products = Product::latest()->paginate(5);
        return view('index',compact('products', 'companies'))
        -> with('page_id',request()->page_id)
        -> with('i', (request()->input('page', 1) - 1) * 5);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
            return view('create')
        ->with('companies',$companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name'=> 'required|max:20',
            'name' => 'required|max:20',
            'company_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => 'required',
        ]);
    
        $dir = 'img_paths';

        $path = $request->file('img_path')->store('public/' . $dir);

    $product = new Product;
        $product->user_name = $request->input("user_name");
        $product->name = $request->input("name");
        $product->company_id = $request->input("company_id");
        $product->price = $request->input("price");
        $product->stock = $request->input("stock");
        $product->comment = $request->input("comment");
        $product->img_path = $path;
        $product->save();

        return redirect()->route('products.index')->with("success", '登録しました');
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
            return view ('show',compact('product'))
            ->with('page_id',request()->page_id)
        ->with('companies',$companies);
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
            return view ('edit',compact('product'))
        ->with('companies',$companies);
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
        $request->validate([
            'user_name'=> 'required|max:20',
            'name' => 'required|max:20',
            'company_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
        ]);
    
        if($request->file('img_path')){
            $dir = 'img_paths';
            $path = $request->file('img_path')->store('public/' . $dir);
        }

        $product->user_name = $request->input("user_name");
        $product->name = $request->input("name");
        $product->company_id = $request->input("company_id");
        $product->price = $request->input("price");
        $product->stock = $request->input("stock");
        $product->comment = $request->input("comment");
        if($request->file('img_path')){
            $product->img_path = $path;
        }
        $product->save();

        $page = request()->input('page');

        return redirect()->route('products.index', ['page' => $page])
        ->with("success", '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with("success",$product->name.'を削除しました');
    }
}
