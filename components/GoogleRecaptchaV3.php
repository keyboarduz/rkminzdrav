<?php
namespace app\components;

use Yii;

class GoogleRecaptchaV3
{
    private $secretKey;
    private $result;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    private function getCaptcha()
    {
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret="
            .Yii::$app->params['secret_key']
            ."&response={$this->secretKey}"
        );

        $this->result = json_decode($response);

        return $this->result;
    }

    public function isValidRequest(): bool
    {
        $jsonResult = $this->getCaptcha();

        if ($jsonResult->success == true && $jsonResult->score > 0.5) {
            return true;
        }

        return false;
    }

    public function getResult()
    {
        return $this->result;
    }
}