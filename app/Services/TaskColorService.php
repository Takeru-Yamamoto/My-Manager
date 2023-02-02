<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\TaskColor as Forms;
use App\Consts\TextConst;

class TaskColorService extends BaseService
{
    public function create(Forms\CreateForm $form): string
    {
        $taskColor = $this->TaskColorRepository->createEntity(
            $form->color,
            $form->description
        );

        $taskColor->safeCreate();

        return TextConst::TASK_COLOR_CREATED;
    }

    public function update(Forms\UpdateForm $form): string
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $taskColor->color       = $form->color;
        $taskColor->description = $form->description;

        $taskColor->safeUpdate();

        return TextConst::TASK_COLOR_UPDATED;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $taskColor->safeDelete();
    }
}
