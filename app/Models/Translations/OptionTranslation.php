<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\Option;

class OptionTranslation extends Model
{
    protected $baseModuleModel = Option::class;
}
