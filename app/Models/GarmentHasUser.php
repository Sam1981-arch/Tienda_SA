<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GarmentHasUser extends Model
{
    use HasFactory,SoftDeletes;

	protected $fillabase =[
		'brand_id',
		'user_id',
		'date_loan',
		'date_return',

	];

	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function Garment()
	{
		return $this->belongsTo(Garment::class, 'garment_id', 'id');
	}
}
