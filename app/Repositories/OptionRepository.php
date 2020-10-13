<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleBrowsers;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Option;

class OptionRepository extends ModuleRepository
{
	use HandleTranslations, HandleSlugs, HandleMedias, HandleBrowsers;

	protected $fieldsGroups = [
		'options' => ['instagram', 'facebook', 'twitter', 'youtube', 'phone', 'fax', 'email', 'hours', 'address', 'programs', 'about', 'maintenance', 'impressum', 'description']
	];

	protected $relatedBrowsers = [];

	public function __construct(Option $model)
	{
		$this->model = $model;
	}

	public function afterSave($object, $fields)
	{
		foreach ($this->relatedBrowsers as $browserName) {
			$this->updateRelatedBrowser($object, $fields, $browserName);
		}
		parent::afterSave($object, $fields);
	}

	public function getFormFields($object)
	{
		$fields = parent::getFormFields($object);

		foreach ($this->relatedBrowsers as $browserName) {
			$fields['browsers'][$browserName] = $this->getFormFieldsForRelatedBrowser($object, $browserName);
		}
		
		return $fields;
	}

}
