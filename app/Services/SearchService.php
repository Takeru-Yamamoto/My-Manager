<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Search as Forms;

class SearchService extends BaseService
{
    public function search(Forms\SearchForm $form): array|null
    {
        $repository = match ($form->model) {
            "user"          => $this->UserRepository,
            "emailReset"    => $this->EmailResetRepository,
            "passwordReset" => $this->PasswordResetRepository,
            "attendance"    => $this->AttendanceRepository,
            "task"          => $this->TaskRepository,
            "taskColor"     => $this->TaskColorRepository,
        };

        $results = null;
        $from    = $form->from;
        $to      = $form->to;

        $repository->select([$from, $to])->limit($form->limit);

        if (is_array($form->additional)) {
            foreach ($form->additional as $column => $value) {
                $repository->where($column, $value);
            }
        }

        $results = match ($form->eloquent) {
            "where" => $repository->getRaw($from, $form->value),
            "like"  => $repository->whereLike($from, $form->value)->getRaw(),
        };

        if (is_null($results)) return $results;

        $moldedResults = [];

        foreach ($results as $result) {
            $moldedResults[] = [
                "from" => $result->$from,
                "to" => $result->$to,
            ];
        }

        return $moldedResults;
    }
}
