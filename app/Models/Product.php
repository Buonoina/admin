<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
<<<<<<< HEAD

    public static function searchProducts(Request $request)
    {
        $productQuery = self::query();

        if ($request->filled('search')) {
            $productQuery->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->filled('company')) {
            $productQuery->where('company_id', $request->input('company'));
        }

        return $productQuery->orderBy('company_id', 'asc')->paginate(10);
    }

    public static function validateProduct(Request $request, $update = false)
    {
        $rules = [
            'name' => 'required|max:20',
            'company_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => $update ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        return Validator::make($request->all(), $rules);
    }

    /**
     * 商品を作成するメソッド
     *
     * @param \Illuminate\Http\Request $request
     * @return Product
     */
    public static function createProduct(Request $request)
    {
        return DB::transaction(function () use ($request) {
            // バリデーション
            self::validateProduct($request);
            
            // 画像の保存
            $dir = 'img_paths';
            $path = $request->file('img_path')->store('public/' . $dir);

            // 商品の新規作成
            $product = new self();
            $product->name = $request->input("name");
            $product->company_id = $request->input("company_id");
            $product->price = $request->input("price");
            $product->stock = $request->input("stock");
            $product->comment = $request->input("comment");
            $product->img_path = $path;
            $product->save();

            return $product;
        });
    }

    /**
     * 商品を更新するメソッド
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return Product
     */
    public static function updateProduct(Request $request, Product $product)
    {
        return DB::transaction(function () use ($request, $product) {
            // バリデーション
            self::validateProduct($request, true);
    
            // 画像の保存（新しい画像がある場合）
            if ($request->file('img_path')) {
                $dir = 'img_paths';
                $path = $request->file('img_path')->store('public/' . $dir);
                $product->img_path = $path; // 新しい画像パスを更新
            }
    
            // 商品の更新
            $product->name = $request->input("name");
            $product->company_id = $request->input("company_id");
            $product->price = $request->input("price");
            $product->stock = $request->input("stock");
            $product->comment = $request->input("comment");
            $product->save();
    
            return $product;
        });
    }
}
