<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\PressItem;

class PressItemRepository extends ModuleRepository
{
    use HandleFiles;

    public function __construct(PressItem $model)
    {
        $this->model = $model;
    }
}
