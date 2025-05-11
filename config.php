<?php
require_once INCLUDE_DIR.'class.plugin.php';

class DiscordConfig extends PluginConfig {
    function getOptions() {
        return [
            'discord_webhook_url' => new TextboxField([
                'label'         => 'Discord Webhook URL',
                'configuration' => ['size' => 80, 'length' => 200],
                'required'      => true
            ]),
            'discord_username' => new TextboxField([
                'label'         => 'Discord Username',
                'configuration' => ['size' => 40, 'length' => 100],
                'hint'          => 'The name that appears as the webhook sender',
                'required'      => false
            ]),
            'discord_avatar_url' => new TextboxField([
                'label'         => 'Avatar URL',
                'configuration' => ['size' => 80, 'length' => 255],
                'hint'          => 'Full HTTPS URL to the avatar image (128x128 PNG recommended)',
                'required'      => false
            ]),
        ];
    }
}
?>
