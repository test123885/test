<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'author_id',   
        'cat_id', 
        'bookname', 
        'photo',
        'price',
        'details',
        'pdf',
        'statuse'
    ];

    public function Category() {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // تأكد من استخدام الاسم الصحيح للعمود
    }

}
