<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\PasswordForgot as Forms;
use App\Consts\TextConst;
use App\Consts\MailConst;

class PasswordForgotService extends BaseService
{

    public function sendPasswordResetMail(Forms\receiveEmailAddressForm $form): string
    {
        if (!$this->UserRepository->where("email", $form->email)->isExist()) {
            return TextConst::EMAIL_ADDRESS_NOT_EXIST;
        }

        $token = hashedRandomText(40);

        $entity = $this->PasswordResetRepository->createEntity(
            $form->email,
            $token,
            expirationDate(MailConst::EXPIRATION_MINUTE)
        );

        Transaction(
            'パスワードリセット登録',
            function () use ($entity) {
                $entity->save();
            }
        );

        $data["url"] = url("password_reset/" . $token . "/" . $form->email);

        return sendMail(MailConst::PASSWORD_FORGOT, $data, $form->email) ? TextConst::EMAIL_SEND_SUCCESS : TextConst::EMAIL_SEND_FAILURE;
    }

    public function checkTokenAndEmailExist(Forms\PasswordResetPreparationForm $form): ?string
    {
        return $this->PasswordResetRepository->where('token', $form->token)->where('email', $form->email)->isExist() ? null : TextConst::AUTHENTICATION_FAILURE;
    }

    public function resetPassword(Forms\PasswordResetForm $form): string
    {
        $user = $this->UserRepository->where("email", $form->email)->findRaw();

        $user->password = makeHash($form->password);

        Transaction(
            'パスワード更新',
            function () use ($user) {
                $user->save();
            }
        );

        return TextConst::PASSWORD_RESET_SUCCESS;
    }
}
