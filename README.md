Discord Notifier for osTicket

Discord plugin to post new tickets to a Discord channel.

Features

Automatically notify a Discord channel when a new ticket is created in osTicket.

Configure multiple webhook instances for different departments or channels.

Customizable sender name and avatar per instance.

Requirements

osTicket 1.14.15 or later (1.15+ recommended)

PHP 7.4+ with cURL and JSON extensions enabled

Installation

Download or clone this repository into your osTicket include/plugins/discord directory:

cd /path/to/osticket/include/plugins
git clone https://github.com/username/osticket-discord-notifier discord

(Optional) Build a PHAR bundle instead of deploying files directly:

cd discord
php -d phar.readonly=0 build-phar.php
cp discord-notifier.phar /path/to/osticket/include/plugins/

Clear osTicket’s cache:

rm /path/to/osticket/include/ost-config.php

Log in to the osTicket Admin Panel and go to Manage → Plugins. You should see “Discord Notifier” listed.

Configuration

Navigate to Manage → Plugins → Plugin Instances.

Click Add New Instance and select Discord Notifier.

Fill in the following fields:

Discord Webhook URL: Your Discord channel’s webhook URL.

Discord Username (optional): The name to display as the webhook sender (default: osTicket).

Avatar URL (optional): HTTPS URL to a 128×128‑pixel PNG for the webhook avatar.

Under Applicability, select the Departments and/or Help Topics you want this instance to apply to (or choose All for global notifications).

Click Save.

Usage

Once configured, every time a new ticket is created (in a scoped department/topic), the plugin will post a notification to the specified Discord channel:

Username and avatar reflect your instance settings.

Content includes ticket ID, subject, and requester information.

Screenshots

Uploading plugin files:
![image](https://github.com/user-attachments/assets/cb674ce7-6a77-4277-abb6-5a6864533b02)

Installing the plugin:
![image](https://github.com/user-attachments/assets/3bad3e2c-6ce3-4009-ab14-d3055a572871)

Creating a new instance:
![image](https://github.com/user-attachments/assets/e5fa94ae-93d8-4dc6-af26-51efad92a80d)

Contributing

Contributions, issues, and feature requests are welcome! Feel free to check issues page or submit a PR.

License

This project is licensed under the MIT License. See the LICENSE file for details.
