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
                $task->comment
            );
        }

        return response()->json($events);
    }

    public function create(Forms\CreateForm $form): string
    {
        $task = $this->TaskRepository->createEntity(
            authUserId(),
            $form->title,
            $form->comment,
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

        $task->start_date = $form->startDate;
        $task->end_date   = $form->endDate;
        $task->title      = $form->title;
        $task->comment    = $form->comment;

        Transaction(
            'タスク情報 更新',
            function () use ($task) {
                $task->save();
            }
        );

        return TextConst::TASK_CREATED;
    }
}
