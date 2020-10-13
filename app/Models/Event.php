<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;
use App\Inc\Traits\ServesImages;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Event extends Model 
{
    use HasTranslation, HasSlug, HasMedias, ServesImages;

	protected $fillable = [
		'published',
		'title',
		'subtitle',
		'description',
		'genre',
		'curator',
		'artists',
		'coop',
		'partners',
		'press',
		'color',
		'summary',
		'start',
		'end',
		'series',
		'virtual',
		'start_time',
		'end_time',
		'monoscope'
	];

	protected $dates = ['start', 'end'];

	public $translatedAttributes = [
		'title',
		'subtitle',
		'description',
		'active',
		'summary',
		'genre'
	];

	public $slugAttributes = [
		'title',
	];

	public function categories()
	{
		return $this->belongsToMany('App\Models\Category');
	}

	public function pressItems()
	{
		return $this->hasMany('App\Models\PressItem');
	}

	public function scopeCurrent($query)
	{
		$now = now();
		return $query->whereDate('start', '<=', $now)->whereDate('end', '>=', $now);
	}

	public function scopeVirtual($query)
	{
		return $query->where('virtual', '=', 1);
	}

	public function scopePhysical($query)
	{
		return $query->where('virtual', '!=', 1)->orWhereNull('virtual');
	}

	public function scopeSeries($query)
	{
		return $query->where('series', '=', 1);
	}

	public function scopeStandard($query)
	{
		return $query->where('series', '!=', 1)->orWhereNull('series');
	}

	public function scopeFuture($query)
	{
		return $query->whereDate('start', '>', now());
	}

	public function getPeriodAttribute()
	{
		if (isset($this->start) && isset($this->end)) {
			return new CarbonPeriod($this->start, $this->end);
		}
		return false;
	}

	public function getFormattedStartTimeAttribute()
	{
		if (!empty($this->start_time)) {
			return Carbon::create($this->start_time)->isoFormat('LT');
		}
		return false;
	}

	public function getFormattedEndTimeAttribute()
	{
		if (!empty($this->end_time)) {
			return Carbon::create($this->end_time)->isoFormat('LT');
		}
		return false;
	}
}
