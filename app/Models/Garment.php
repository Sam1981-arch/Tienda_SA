<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Brand;
use App\Models\GarmentHasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garment extends Model
{
	use HasFactory,SoftDeletes;

	protected $fillable = [
		'brand_id',
		'category_id',
		'name',
		'stock',
		'Description',
		'price'

	];


	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'id');
	}

	public function garmentHasUser()
	{
		return $this->belongsTo(GarmentHasUser::class, 'garment_id', 'id');
	}

}
