<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

use App\Consts\TextConst;

class UpdateForm extends BaseForm
{
    public $id;
    public $startDate;
    public $endDate;
    public $title;
    public $comment;
    public $taskColorId;

    protected function validationRule(): array
    {
        return [
            'id'            => 'required|' . Rule::INTEGER,
            'start_date'    => 'required|' . Rule::STRING,
            'end_date'      => 'required|' . Rule::STRING,
            'title'         => 'required|' . Rule::STRING,
            'comment'       => 'nullable|' . Rule::STRING,
            'task_color_id' => 'nullable|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id          = intval($input['id']);
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
