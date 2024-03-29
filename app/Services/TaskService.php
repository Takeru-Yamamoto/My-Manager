<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Task as Forms;
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

    public function create(Forms\CreateForm $form): bool
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

        return true;
    }

    public function update(Forms\UpdateForm $form): bool
    {
        $task = $this->TaskRepository->findRawById($form->id);

        $task->start_date    = $form->startDate;
        $task->end_date      = $form->endDate;
        $task->title         = $form->title;
        $task->comment       = $form->comment;
        $task->task_color_id = $form->taskColorId;

        $task->safeUpdate();

        return true;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $task = $this->TaskRepository->findRawById($form->id);

        $task->safeDelete();
    }
}
