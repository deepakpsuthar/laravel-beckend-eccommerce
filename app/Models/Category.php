<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'description',
        'status',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->hasOne(Product::class);
    }

    protected function getActionAttribute(): string
    {
        $action = '<a href="' . route('admin.categories.edit', $this->attributes['id']) . '" ><i class="fa-regular fa-pen-to-square"></i></a>';

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
