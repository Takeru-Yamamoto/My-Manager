<?php

use Illuminate\Support\Facades\DB;
use App\Exceptions;

if (!function_exists('Transaction')) {

    function Transaction(string $description, \Closure $transactional): void
    {
        $exception = null;

        emphasisLogStart("TRANSACTION");

        DB::beginTransaction();

        try {
            $transactional();

            // COMMIT
            DB::commit();

            infoLog("SUCCESS TRANSACTION " . $description);
        } catch (\Exception $e) {
            $description = $description ? $description : "";

            $message = "FAILURE TRANSACTION " . $description;
            infoLog($message);

            try {
                // ROLLBACK
                DB::rollback();

                $message .= " ロールバックに成功しています。";
                infoLog("ROLLBACK: success");
            } catch (\Exception $e2) {
                $message .= " ロールバックに失敗しました。 Caused By " . $e2->getMessage();
                infoLog("ROLLBACK: success");
                infoLog("CAUSED: " . $e2->getMessage());
            }

            $exception = new Exceptions\DBUtilException($message, $e);
        }

        emphasisLogEnd("TRANSACTION");

        if (!is_null($exception)) throw $exception;
    }
}
