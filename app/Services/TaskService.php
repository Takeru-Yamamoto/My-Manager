<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Task as Forms;
use App\Consts\TextConst;
use Illuminate\Http\JsonResponse;

class TaskService extends BaseService
{
    public function fetch(Forms\FetchForm $form): JsonResponse
    {
        $tasks = $this->TaskRepository
            ->whereClosure(function ($query) use ($form) {
                $query->whereBetween("start_date", [$form->startDate, $form->endDate])
                    ->orWhereBetween("end_date", [$form->startDate, $form->endDate]);
            })->get();

        if (is_null($tasks)) return responseJson();

        $events = [];

        foreach ($tasks as $task) {
            $events[] = convertToCalendarEvent(
                $task->id,
                $task->title,
                $task->startDate,
                $task->endDate,
                $task->comment,
                is_null($task->taskColor) ? null : convertToBootstrapColorCode($task->taskColor->color)
            );
        }

        return responseJson($events);
    }

    public function create(Forms\CreateForm $form): string
    {
        $task = $this->TaskRepository->createEntity(
            authUserId(),
            $form->title,
            $form->comment,
            $form->taskColorId,
            $form->startDate,
            $form->endDate
        );

        $task->safeCreate();

        return TextConst::TASK_CREATED;
    }

    public function update(Forms\UpdateForm $form): string
    {
        $task = $this->TaskRepository->findRawById($form->id);

        if (is_null($task)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $task->start_date    = $form->startDate;
        $task->end_date      = $form->endDate;
        $task->title         = $form->title;
        $task->comment       = $form->comment;
        $task->task_color_id = $form->taskColorId;

        $task->safeUpdate();

        return TextConst::TASK_UPDATED;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $task = $this->TaskRepository->findRawById($form->id);

        if (is_null($task)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $task->safeDelete();
    }

    public function createTaskColor(Forms\CreateTaskColorForm $form): string
    {
        $taskColor = $this->TaskColorRepository->createEntity(
            $form->color,
            $form->description
        );

        $taskColor->safeCreate();

        return TextConst::TASK_COLOR_CREATED;
    }

    public function updateTaskColor(Forms\UpdateTaskColorForm $form): string
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $taskColor->color       = $form->color;
        $taskColor->description = $form->description;

        $taskColor->safeUpdate();

        return TextConst::TASK_COLOR_UPDATED;
    }

    public function deleteTaskColor(Forms\DeleteTaskColorForm $form): void
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $taskColor->safeDelete();
    }
}
