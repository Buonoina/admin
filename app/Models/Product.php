<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            'company_id' => 'required|integer|exists:companies,id', // 存在確認を追加
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => $update ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'name.required' => __('messages.name_required'),
            'company_id.required' => __('messages.company_required'), // 既存のメッセージ
            'company_id.integer' => __('messages.select_company'), // 整数のエラーメッセージ
            'company_id.exists' => __('messages.select_company'), // 存在しない場合のエラーメッセージ
            'price.required' => __('messages.price_required'),
            'stock.required' => __('messages.stock_required'),
            'comment.required' => __('messages.comment_required'),
            'img_path.required' => __('messages.img_path_required'),
            'img_path.image' => __('messages.img_path_image'),
            'img_path.max' => __('messages.img_path_max'),
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * 商品を作成するメソッド
     *
     * @param \Illuminate\Http\Request $request
     * @return Product
     * @throws \Exception
     */
    // createProductメソッド内でバリデーションを行う
    public static function createProduct(Request $request)
    {
        // トランザクション開始
        return DB::transaction(function () use ($request) {
            // バリデーション
            $validation = self::validateProduct($request);
            if ($validation->fails()) {
                // バリデーションエラーの場合、例外をスロー
                throw new \Illuminate\Validation\ValidationException($validation);
            }

            // 画像の保存
            $path = $request->file('img_path')->store('public/img_paths');

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
     * @throws \Exception
     */
    public static function updateProduct(Request $request, Product $product)
    {
        return DB::transaction(function () use ($request, $product) {
            // バリデーション
            $validation = self::validateProduct($request, true);
            if ($validation->fails()) {
                throw new \Exception($validation->errors()->first());
            }

            // 画像の保存（新しい画像がある場合）
            if ($request->file('img_path')) {
                // 古い画像を削除
                if ($product->img_path) {
                    Storage::delete($product->img_path);
                }
                // 新しい画像を保存
                $path = $request->file('img_path')->store('public/img_paths');
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

    /**
     * 商品を削除するメソッド
     *
     * @param Product $product
     * @return void
     */
    public static function deleteProduct(Product $product)
    {
        DB::transaction(function () use ($product) {
            // 古い画像の削除
            if ($product->img_path) {
                Storage::delete($product->img_path);
            }
            $product->delete();
        });
    }
}