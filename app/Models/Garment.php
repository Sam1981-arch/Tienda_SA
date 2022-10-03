<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Brand;
use App\Models\GarmentHasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garment extends Model
{
	use HasFactory,SoftDeletes;

	protected $fillabses = [
		'brand_id',
		'category_id',
		'title',
		'stock',

	];


	public function Category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function Brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'id');
	}

	public function GarmentHasUsers()
	{
		return $this->belongsTo(GarmentHasUsers::class, 'garment_id', 'id');
	}

}
