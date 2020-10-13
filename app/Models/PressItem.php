<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Model;

class PressItem extends Model 
{
    use HasFiles;

	protected $dates = ['date'];

    protected $fillable = [
        'published',
        'title',
		'publication',
		'url',
		'date',
		'event_id'
	];
	
	public $filesParams = ['attachment'];

	public function event()
	{
		return $this->belongsTo('App\Models\Event');
	}
    
}
