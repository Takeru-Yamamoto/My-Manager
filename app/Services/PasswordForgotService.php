<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\PasswordForgot as Forms;

class PasswordForgotService extends BaseService
{
    public function sendPasswordResetMail(Forms\ReceiveEmailAddressForm $form): bool
    {
        $token = hashedRandomText(40);

        $entity = $this->PasswordResetRepository->createEntity(
            $form->email,
            $token,
            expirationDate(config("email.expiration_minute"))
        );

        $entity->safeCreate();

        $data["url"] = route("passwordResetForm", ["token" => $token, "email" => $form->email]);

        return sendMail("passwordForgot", $data, $form->email);
    }

    public function resetPassword(Forms\PasswordResetForm $form): bool
    {
        $user = $this->UserRepository->where("email", $form->email)->findRaw();

        $user->password = makeHash($form->password);

        $user->safeUpdate();

        return true;
    }
}
