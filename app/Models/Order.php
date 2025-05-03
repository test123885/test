<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'author_id',
        'checkout_id',
        'book_id',
        'statuse', 
        'quantaty',  
      
         
        
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // تأكد من أن 'author_id' هو العمود الصحيح
    }

}
