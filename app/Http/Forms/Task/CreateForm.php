<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class CreateForm extends BaseForm
{
    public $startDate;
    public $endDate;
    public $title;
    public $comment;
    public $taskColorId;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'start_date'    => $this->required($this->date(), $this->before("end_date")),
            'end_date'      => $this->required($this->date(), $this->after("start_date")),
            'title'         => $this->required($this->string()),
            'comment'       => $this->nullable($this->string()),
            'task_color_id' => $this->nullable($this->id("task_colors")),
        ];
    }

    protected function bind(): void
    {
        $this->startDate   = strval($this->input['start_date']);
        $this->endDate     = strval($this->input['end_date']);
        $this->title       = strval($this->input['title']);
        $this->comment     = isset($this->input['comment']) ? strval($this->input['comment']) : null;
        $this->taskColorId = isset($this->input['task_color_id']) ? intval($this->input['task_color_id']) : null;
    }

    protected function afterBinding(): void
    {
    }
}
