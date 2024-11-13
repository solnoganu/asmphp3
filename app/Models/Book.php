<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'description',
        'publication',
        'view_count',
        'thumbnail', // Thêm thumbnail vào đây
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incrementViewCount()
    {
        $this->view_count++;
        $this->save();
    }
}
