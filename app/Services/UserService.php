<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\User as Forms;
use App\Repositories\Results;
use App\Consts\TextConst;

use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends BaseService
{
    public $limit = 10;

    public function getLowerThanRole(Forms\IndexForm $form): LengthAwarePaginator|null
    {
        if (is_null($form->name)) {
            $repository = $this->UserRepository->whereGreater("role", authUserRole());
        } else {
            $repository = $this->UserRepository->whereGreater("role", authUserRole())->whereLike("name", $form->name);
        }

        return paginatorByRepository($repository, $this->limit, $form->page);
    }

    public function create(Forms\CreateForm $form): string
    {
        $user = $this->UserRepository->createEntity(
            $form->name,
            $form->email,
            makeHash($form->password),
            $form->role
        );

        $user->safeCreate();

        return TextConst::USER_CREATED;
    }

    public function findById(int $id): Results\UserResult
    {
        return $this->UserRepository->findById($id);
    }

    public function update(Forms\UpdateForm $form): string
    {
        $user = $this->UserRepository->findRawById($form->id);

        if (is_null($user)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $user->role = $form->role;
        $user->email = $form->email;
        if (!is_null($form->password)) {
            $user->password = makeHash($form->password);
        }

        $user->safeUpdate();

        return TextConst::USER_UPDATED;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        if (is_null($user)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $user->safeDelete();
    }

    public function changeIsValid(Forms\ChangeIsValidForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        if (is_null($user)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $user->changeIsValid($form->isValid);
    }
}
