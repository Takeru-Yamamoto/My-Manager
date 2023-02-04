<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Search as Forms;

class SearchService extends BaseService
{
    public function search(Forms\SearchForm $form): array|null
    {
        $repository = null;

        switch ($form->model) {
            case "user":
                $repository = $this->UserRepository;
                break;
            case "emailReset":
                $repository = $this->EmailResetRepository;
                break;
            case "passwordReset":
                $repository = $this->PasswordResetRepository;
                break;
        }

        $results = null;
        $from    = $form->from;
        $to      = $form->to;

        $repository->select([$from, $to])->limit($form->limit);

        if (is_array($form->additional)) {
            foreach ($form->additional as $column => $value) {
                $repository->where($column, $value);
            }
        }

        switch ($form->eloquent) {
            case "where":
                $results = $repository->getRaw($from, $form->value);
                break;
            case "like":
                $results = $repository->whereLike($from, $form->value)->getRaw();
                break;
        }

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
