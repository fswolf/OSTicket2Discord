<?php
require_once INCLUDE_DIR.'class.plugin.php';
require_once INCLUDE_DIR.'class.signal.php';
require_once __DIR__.'/config.php';

class DiscordPlugin extends Plugin {
    var $config_class = 'DiscordConfig';

    function bootstrap() {
        Signal::connect('ticket.created', [$this, 'onTicketCreated']);
    }

    function onTicketCreated($ticket) {
        $instances = Plugin::getInstances('discord', true);
        foreach ($instances as $instance) {
            $cfg = $instance->getConfig();
            $url   = trim($cfg->get('discord_webhook_url'));
            if ($url) {
                $username   = trim($cfg->get('discord_username')) ?: 'osTicket';
                $avatar_url = trim($cfg->get('discord_avatar_url')) ?: '';

                $this->postToDiscord($ticket, $url, $username, $avatar_url);
            }
        }
    }

    protected function postToDiscord($ticket, $webhookUrl, $username, $avatarUrl) {
        $payload = [
            'username'   => $username,
            'avatar_url' => $avatarUrl,
            'content'    => "@everyone \n**New Ticket!**\n"
                         . "**Subject:** {$ticket->getSubject()}\n"
                         . "**From:** {$ticket->getName()} ({$ticket->getEmail()})\n"
                         . "**ID:** {$ticket->getId()}"
        ];

        $ch = curl_init($webhookUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $resp     = curl_exec($ch);
        $errno    = curl_errno($ch);
        $errmsg   = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // error_log("DiscordPlugin[{$webhookUrl}] code={$httpcode} errNo={$errno} err='{$errmsg}' resp='{$resp}'");
    }
}
?>