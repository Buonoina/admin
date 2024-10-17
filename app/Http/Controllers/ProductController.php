<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; 

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $company = $request->input('company'); 

        $companies = Company::all();

        $product_query = Product::query();

        // 商品検索条件を追加
        if ($search) {
            $product_query->where('name', 'LIKE', "%{$search}%");
        }

        if ($company) {
            $product_query->where('company_id', $company);
        }

        // 商品一覧を 10 ごとに作成
        $products = $product_query->orderBy('company_id', 'asc')->paginate(10);

        // products と companies を view に渡す。
        return view('index', compact('products', 'companies'))
            ->with('page_id', request()->page_id)
            ->with('i', (request()->input('page', 1) - 1) * 10);
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
        // バリデーションを実行
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'company_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => config('messages.name_required'),
            'company_id.required' => config('messages.company_required'),
            'price.required' => config('messages.price_required'),
            'stock.required' => config('messages.stock_required'),
            'comment.required' => config('messages.comment_required'),
            'img_path.required' => config('messages.img_path_required'),
            'img_path.image' => config('messages.img_path_image'),
            'img_path.max' => config('messages.img_path_max'),
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // トランザクション開始
        try {
            DB::transaction(function () use ($request) {
                // 画像の保存
                $path = $request->file('img_path')->store('public/img_paths');

                // 新しい商品を作成
                $product = new Product();
                $product->name = $request->input("name");
                $product->company_id = $request->input("company_id");
                $product->price = $request->input("price");
                $product->stock = $request->input("stock");
                $product->comment = $request->input("comment");
                $product->img_path = $path; // 保存した画像のパスをセット
                $product->save();
            });
        } catch (\Exception $e) {
            // エラーログを記録
            \Log::error('商品登録中にエラーが発生しました: ' . $e->getMessage());
            return redirect()->back()->with('error', '商品登録中にエラーが発生しました。')->withInput();
        }

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
        // バリデーションを実行
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'company_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => config('messages.name_required'),
            'company_id.required' => config('messages.company_required'),
            'price.required' => config('messages.price_required'),
            'stock.required' => config('messages.stock_required'),
            'comment.required' => config('messages.comment_required'),
        ]);

        // バリデーションが失敗した場合
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // トランザクション開始
        try {
            DB::transaction(function () use ($request, $product) {
                $product->fill($request->except('img_path'));

                if ($request->file('img_path')) {
                    $path = $request->file('img_path')->store('public/img_paths');
                    $product->img_path = $path;
                }

                $product->save();
            });
        } catch (\Exception $e) {
            // エラーログを記録
            \Log::error('商品更新中にエラーが発生しました: ' . $e->getMessage());
            return redirect()->back()->with('error', '商品更新中にエラーが発生しました。')->withInput();
        }

        return redirect()->route('products.index')->with("success", '更新しました');
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
        return redirect()->route('products.index')->with("success", $product->name . 'を削除しました');
    }
}

