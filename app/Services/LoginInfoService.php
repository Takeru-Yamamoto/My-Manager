<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\LoginInfo as Forms;
use App\Consts\TextConst;
use App\Consts\MailConst;

class LoginInfoService extends BaseService
{
    public function update(Forms\UpdateForm $form): string
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->role = $form->role;
        if (!is_null($form->email)) {
            $user->email = $form->email;
        }
        if (!is_null($form->password)) {
            $user->password = makeHash($form->password);
        }

        Transaction(
            'ログイン情報更新',
            function () use ($user) {
                $user->save();
            }
        );

        return TextConst::LOGIN_INFO_UPDATED;
    }

    public function authenticationCodeForm(Forms\AuthenticationCodeForm $form): ?string
    {
        if ($this->UserRepository->where("email", $form->email)->isExist()) {
            return TextConst::EMAIL_ADDRESS_EXIST;
        }

        $authenticationCode = createRandomNumber(6);

        $entity = $this->EmailResetRepository->createEntity(
            $form->userId,
            $authenticationCode,
            $form->email,
            expirationDate(MailConst::EXPIRATION_MINUTE)
        );

        Transaction(
            'E-Mail リセット登録',
            function () use ($entity) {
                $entity->save();
            }
        );

        $isSendEmailReset = sendMail(MailConst::EMAIL_RESET, ["authenticationCode" => $authenticationCode], $form->email);

        return $isSendEmailReset ? null : TextConst::EMAIL_SEND_FAILURE;
    }

    public function changeEmail(Forms\ChangeEmailForm $form): ?string
    {
        $authenticateResult = $this->EmailResetRepository->where("user_id", $form->userId)->where("authentication_code", $form->authenticationCode)->findRaw();

        if (is_null($authenticateResult)) return null;

        if (dateUtil($authenticateResult->expiration_date)->isPast()) return TextConst::EMAIL_CHANGED_EXPIRED;

        $user = authUser();

        $user->email = $authenticateResult->new_email;

        Transaction(
            'ユーザーE-Mail更新',
            function () use ($user) {
                $user->save();
            }
        );

        return TextConst::EMAIL_CHANGED_SUCCESS;
    }
}
