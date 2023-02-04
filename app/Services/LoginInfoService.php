<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\LoginInfo as Forms;
use App\Consts\MailConst;

class LoginInfoService extends BaseService
{
    public function update(Forms\UpdateForm $form): bool
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->role = $form->role;
        if (!is_null($form->email)) {
            $user->email = $form->email;
        }
        if (!is_null($form->password)) {
            $user->password = makeHash($form->password);
        }

        $user->safeUpdate();

        return true;
    }

    public function authenticationCodeForm(Forms\AuthenticationCodeForm $form): bool
    {
        $authenticationCode = createRandomNumber(6);

        $entity = $this->EmailResetRepository->createEntity(
            $form->userId,
            $authenticationCode,
            $form->email,
            expirationDate(MailConst::EXPIRATION_MINUTE)
        );

        $entity->safeCreate();

        return sendMail(MailConst::EMAIL_RESET, ["authenticationCode" => $authenticationCode], $form->email);
    }

    public function changeEmail(Forms\ChangeEmailForm $form): bool
    {
        $authenticateResult = $this->EmailResetRepository->where("user_id", $form->userId)->where("authentication_code", $form->authenticationCode)->findRaw();

        if (dateUtil($authenticateResult->expiration_date)->isPast()) return false;

        $user = authUser();

        $user->email = $authenticateResult->new_email;

        $user->safeUpdate();

        return true;
    }
}
