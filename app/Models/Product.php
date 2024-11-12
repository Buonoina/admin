<?php

namespace App\Models;
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
            'company_id' => 'required|integer|exists:companies,id',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'img_path' => $update ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'name.required' => __('messages.name_required'),
            'company_id.required' => __('messages.company_required'),
            'company_id.integer' => __('messages.select_company'),
            'company_id.exists' => __('messages.select_company'),
            'price.required' => __('messages.price_required'),
            'stock.required' => __('messages.stock_required'),
            'comment.required' => __('messages.comment_required'),
            'img_path.required' => __('messages.img_path_required'),
            'img_path.image' => __('messages.img_path_image'),
            'img_path.max' => __('messages.img_path_max'),
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public static function createProduct(Request $request)
    {
        $validation = self::validateProduct($request);
        if ($validation->fails()) {
            throw new \Illuminate\Validation\ValidationException($validation);
        }

        $path = $request->file('img_path')->store('public/img_paths');

        return self::create([
            'name' => $request->input("name"),
            'company_id' => $request->input("company_id"),
            'price' => $request->input("price"),
            'stock' => $request->input("stock"),
            'comment' => $request->input("comment"),
            'img_path' => $path,
        ]);
    }

    public static function updateProduct(Request $request, Product $product)
    {
        $validation = self::validateProduct($request, true);
        if ($validation->fails()) {
            throw new \Illuminate\Validation\ValidationException($validation);
        }

        if ($request->file('img_path')) {
            if ($product->img_path) {
                Storage::delete($product->img_path);
            }
            $path = $request->file('img_path')->store('public/img_paths');
            $product->img_path = $path;
        }

        $product->update([
            'name' => $request->input("name"),
            'company_id' => $request->input("company_id"),
            'price' => $request->input("price"),
            'stock' => $request->input("stock"),
            'comment' => $request->input("comment"),
        ]);

        return $product;
    }

    public static function deleteProduct(Product $product)
    {
        if ($product->img_path) {
            Storage::delete($product->img_path);
        }
        $product->delete();
    }
}