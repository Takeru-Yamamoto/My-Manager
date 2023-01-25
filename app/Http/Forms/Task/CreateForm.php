<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

use App\Consts\TextConst;

class CreateForm extends BaseForm
{
    public $startDate;
    public $endDate;
    public $title;
    public $comment;
    public $taskColorId;

    protected function validationRule(): array
    {
        return [
            'start_date'    => $this->required($this->date()),
            'end_date'      => $this->required($this->date()),
            'title'         => $this->required($this->string()),
            'comment'       => $this->nullable($this->string()),
            'task_color_id' => $this->nullable($this->id("task_colors")),
        ];
    }

    protected function bind(array $input): void
    {
        $this->startDate   = strval($input['start_date']);
        $this->endDate     = strval($input['end_date']);
        $this->title       = strval($input['title']);
        $this->comment     = isset($input['comment']) ? strval($input['comment']) : null;
        $this->taskColorId = isset($input['task_color_id']) ? intval($input['task_color_id']) : null;
    }

    protected function validateAfterBinding(): void
    {
        if (dateUtil($this->startDate)->isGreaterEqual(dateUtil($this->endDate)->carbon())) $this->addError(getTextFromConst(TextConst::TASK_DATE_INJUSTICE));
    }
}
