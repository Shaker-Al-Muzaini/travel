<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $date)
 * @method static findOrFail(string $id)
 */
class Hotel extends Model
{
    use HasFactory;
    public  $guarded=[];
    protected static function rules(): array
    {
        return ([
            'name' => 'required|string|min:3|max:100',
//            Rule::unique('categories','name')->ignore($id),

            'image' =>
                'image', 'max:1024500', 'dimensions:min_width=100,min_height=100',
//            'status'=>'required|in:active,archived',
        ]);

    }
}


