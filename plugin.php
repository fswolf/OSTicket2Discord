<?php
return array(
    'id'          => 'discord',                  		   // Must match folder suffix
    'version'     => '0.9.2',
    'name'        => 'Discord Notifier',
    'author'      => 'Ryan Autet',
    'description' => 'Notify Discord on new ticket.',
    'url'         => 'https://github.com/fswolf',
    'plugin'      => 'discord.php:DiscordPlugin',     	   // <file>:<ClassName>
    'config'      => 'config.php:DiscordConfig',           // <file>:<ConfigClassName>
    'instance'    => true                                  // Enables per-instance settings
);
?>