<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\TaskColor as Forms;

class TaskColorService extends BaseService
{
    public function create(Forms\CreateForm $form): bool
    {
        $taskColor = $this->TaskColorRepository->createEntity(
            $form->color,
            $form->description
        );

        $taskColor->safeCreate();

        return true;
    }

    public function update(Forms\UpdateForm $form): bool
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        $taskColor->color       = $form->color;
        $taskColor->description = $form->description;

        $taskColor->safeUpdate();

        return true;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        $taskColor->safeDelete();
    }
}
