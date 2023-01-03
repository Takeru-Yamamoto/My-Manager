<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

use App\Consts\TextConst;

class CreateForm extends BaseForm
{
    public $startDate;
    public $endDate;
    public $title;
    public $comment;

    protected function validationRule(): array
    {
        return [
            'start_date' => 'required|' . Rule::VALUE_STRING,
            'end_date'   => 'required|' . Rule::VALUE_STRING,
            'title'      => 'required|' . Rule::VALUE_STRING,
            'comment'    => 'nullable|' . Rule::VALUE_STRING,
        ];
    }

    protected function bind(array $input): void
    {
        $this->startDate = strval($input['start_date']);
        $this->endDate   = strval($input['end_date']);
        $this->title     = strval($input['title']);
        $this->comment   = isset($input['comment']) ? strval($input['comment']) : null;
    }
    
    protected function validateAfterBinding(): void
    {
        if (dateUtil($this->startDate)->isGreaterEqual(dateUtil($this->endDate)->carbon())) $this->addError(getTextFromConst(TextConst::TASK_DATE_INJUSTICE));
    }
}
