<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\User as Forms;
use App\Repositories\Results;

use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends BaseService
{
    public $limit = 10;

    public function getLowerThanRole(Forms\IndexForm $form): LengthAwarePaginator|null
    {
        $repository = $this->UserRepository->whereGreater("role", authUserRole());

        if (!is_null($form->name)) $repository->whereLike("name", $form->name);
        if (!is_null($form->isValid)) $repository->isValid($form->isValid);

        return paginatorByRepository($repository, $this->limit, $form->page);
    }

    public function create(Forms\CreateForm $form): bool
    {
        $user = $this->UserRepository->createEntity(
            $form->name,
            $form->email,
            makeHash($form->password),
            $form->role
        );

        $user->safeCreate();

        return true;
    }

    public function findById(Forms\UpdatePreparationForm $form): Results\UserResult
    {
        return $this->UserRepository->findById($form->id);
    }

    public function update(Forms\UpdateForm $form): bool
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->name  = $form->name;
        $user->email = $form->email;
        $user->role  = $form->role;
        if (!is_null($form->password)) {
            $user->password = makeHash($form->password);
        }

        $user->safeUpdate();

        return true;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->safeDelete();
    }

    public function changeIsValid(Forms\ChangeIsValidForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->changeIsValid($form->isValid);
    }
}
