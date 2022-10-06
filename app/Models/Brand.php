<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

	protected $table = 'brands';

	protected $fillabase =[
		'name'
	];

	public function brands()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'id');
	}
}
