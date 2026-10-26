<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleBrowsers;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Models\Contracts\TwillModelContract;
use App\Models\Option;

class OptionRepository extends ModuleRepository
{
	use HandleTranslations, HandleSlugs, HandleMedias, HandleBrowsers;

	protected array $fieldsGroups = [
		'options' => ['instagram', 'facebook', 'twitter', 'youtube', 'phone', 'fax', 'email', 'hours', 'address', 'programs', 'about', 'maintenance', 'impressum', 'metatitle', 'metadescription']
	];

	protected $relatedBrowsers = [];

	public function __construct(Option $model)
	{
		$this->model = $model;
	}

	public function afterSave(TwillModelContract $object, array $fields): void
	{
		foreach ($this->relatedBrowsers as $browserName) {
			$this->updateRelatedBrowser($object, $fields, $browserName);
		}
		parent::afterSave($object, $fields);
	}

	public function getFormFields(TwillModelContract $object): array
	{
		$fields = parent::getFormFields($object);

		foreach ($this->relatedBrowsers as $browserName) {
			$fields['browsers'][$browserName] = $this->getFormFieldsForRelatedBrowser($object, $browserName);
		}
		
		return $fields;
	}

}
