<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\PasswordForgot as Forms;
use App\Consts\MailConst;

class PasswordForgotService extends BaseService
{
    public function sendPasswordResetMail(Forms\ReceiveEmailAddressForm $form): bool
    {
        $token = hashedRandomText(40);

        $entity = $this->PasswordResetRepository->createEntity(
            $form->email,
            $token,
            expirationDate(MailConst::EXPIRATION_MINUTE)
        );

        $entity->safeCreate();

        $data["url"] = url("password_reset/" . $token . "/" . $form->email);

        return sendMail(MailConst::PASSWORD_FORGOT, $data, $form->email);
    }

    public function resetPassword(Forms\PasswordResetForm $form): bool
    {
        $user = $this->UserRepository->where("email", $form->email)->findRaw();

        $user->password = makeHash($form->password);

        $user->safeUpdate();

        return true;
    }
}
