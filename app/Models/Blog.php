<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
       'name', 'company_id', 'price', 'stock', 'comment', 'img_path'
    //    'product_name',
    //    'price',
    //    'stock',
    //    'company_id',
    //    'comment',
    //    'img_path',
    //    'created_at',
    //    'updated_at',
    ];
    //リレーション追加
    public function user() {
        return $this->belongsTo(User::class);
}

}
