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
        $taskColors = $this->TaskColorRepository->get();

        foreach ($tasks as $task) {
            $taskColor = arraySearchValue($taskColors, "id", $task->colorId);
            $events[] = convertToCalendarEvent(
                $task->id,
                $task->title,
                $task->startDate,
                $task->endDate,
                $task->comment,
                is_null($taskColor) ? null : convertToBootstrapColorCode($taskColor->color)
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
            $form->colorId,
            $form->startDate,
            $form->endDate
        );

        Transaction(
            'タスク情報 登録',
            function () use ($task) {
                $task->save();
            }
        );

        return TextConst::TASK_CREATED;
    }

    public function update(Forms\UpdateForm $form): string
    {
        $task = $this->TaskRepository->findRawById($form->id);

        if (is_null($task)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $task->start_date = $form->startDate;
        $task->end_date   = $form->endDate;
        $task->title      = $form->title;
        $task->comment    = $form->comment;
        $task->color_id   = $form->colorId;

        Transaction(
            'タスク情報 更新',
            function () use ($task) {
                $task->save();
            }
        );

        return TextConst::TASK_UPDATED;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $task = $this->TaskRepository->findRawById($form->id);

        if (is_null($task)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        Transaction(
            'タスク情報 削除',
            function () use ($task) {
                $task->delete();
            }
        );
    }

    public function createTaskColor(Forms\CreateTaskColorForm $form): string
    {
        $taskColor = $this->TaskColorRepository->createEntity(
            $form->color,
            $form->description
        );

        Transaction(
            'タスク分類 登録',
            function () use ($taskColor) {
                $taskColor->save();
            }
        );

        return TextConst::TASK_COLOR_CREATED;
    }

    public function updateTaskColor(Forms\UpdateTaskColorForm $form): string
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $taskColor->color       = $form->color;
        $taskColor->description = $form->description;

        Transaction(
            'タスク分類 更新',
            function () use ($taskColor) {
                $taskColor->save();
            }
        );

        return TextConst::TASK_COLOR_UPDATED;
    }

    public function deleteTaskColor(Forms\DeleteTaskColorForm $form): void
    {
        $taskColor = $this->TaskColorRepository->findRawById($form->id);

        if (is_null($taskColor)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        Transaction(
            'タスク分類 削除',
            function () use ($taskColor) {
                $taskColor->delete();
            }
        );
    }
}
