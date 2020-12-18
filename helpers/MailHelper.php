<?php
namespace app\helpers;

use Yii;

class MailHelper {
    private $config;

    public function __construct() {
        $configData = Yii::$app->db->createCommand('SELECT * FROM {{%config}}')
            ->queryAll();

        $this->config = array_column($configData, "config_value", "config_name");
    }

    public function send($address, $subject, $contentHtml) {

        try {
            /* @var yii\swiftmailer\Mailer $mailer */
            $mailer = Yii::$app->mailer;

            $transport = new \Swift_SmtpTransport(
                $this->config['smtp_host'], $this->config['smtp_port'], $this->config['smtp_is_ssl'] ? 'tls' : null
            );

            $transport->setUsername($this->config['smtp_address_from']);
            $transport->setPassword($this->config['smtp_password']);

            $mailer->setTransport($transport);

            $message = $mailer->compose()
                ->setFrom([$this->config['smtp_address_from'] => $this->config['smtp_address_from_name']])
                ->setTo($address)
                ->setSubject($subject)
                ->setHtmlBody($contentHtml)
                ->setReplyTo($this->config['smtp_noreply']);

            $sent = $message->send();
            if(!$sent) {
                throw new \Exception('Unsuccessful sending');
            }

            return true;
        }
        catch(\Exception $e) {
            Yii::error($e->getMessage());
            Yii::error($e->getTraceAsString());
            throw new \Exception('ERROR: '.$e->getMessage());
        }
    }
}
