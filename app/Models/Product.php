<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'alias',
        'short_desc',
        'desc',
        'price',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function getActionAttribute(): string
    {
        $action = '<a href="' . route('admin.products.edit', $this->attributes['id']) . '" class=""><i class="fa-regular fa-pen-to-square"></i></a>';

        $action .= '<a href="javascript:void(0);" onClick="deleteHandler(' . $this->attributes['id'] . ');" class="ml-2 action text-danger"><i class="fa-solid fa-trash-can"></i></a>';
        return $action;
    }
    protected function getStatusAttribute(): string
    {
        $action = '<span class="badge bg-danger">'.__('UnPublished').'</span>';
        if($this->attributes['status']){
            $action = '<span class="badge bg-success">'.__('Published').'</span>';
        }
        return $action;
    }
}
