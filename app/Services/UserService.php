<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\User as Forms;
use App\Repositories\Results;
use App\Consts\TextConst;

class UserService extends BaseService
{
    public function getLowerThanRole(): array
    {
        return $this->UserRepository->whereLess("role", authUserRole())->get();
    }

    public function create(Forms\CreateForm $form): string
    {
        $user = $this->UserRepository->createEntity(
            $form->name,
            $form->email,
            makeHash($form->password),
            $form->role
        );

        Transaction(
            'ユーザー情報登録',
            function () use ($user) {
                $user->save();
            }
        );

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

        Transaction(
            'ユーザー情報更新',
            function () use ($user) {
                $user->save();
            }
        );

        return TextConst::USER_UPDATED;
    }

    public function delete(Forms\DeleteForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        if (is_null($user)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        Transaction(
            'ユーザー情報削除',
            function () use ($user) {
                $user->delete();
            }
        );
    }

    public function changeIsValid(Forms\ChangeIsValidForm $form): void
    {
        $user = $this->UserRepository->findRawById($form->id);

        if (is_null($user)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        $user->is_valid = $form->isValid;

        Transaction(
            'ユーザー情報更新',
            function () use ($user) {
                $user->save();
            }
        );
    }
}
