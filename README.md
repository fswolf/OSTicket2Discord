# Discord Notifier for osTicket

Send new osTicket tickets to a Discord channel using a webhook. Keep your team informed with a notification containing the ticket subject, requester details, and internal ticket ID.

## Features

- Sends a notification whenever a new ticket is created.
- Includes the subject, requester's name and email address, and internal ticket ID.
- Supports a custom sender name and avatar.
- Supports multiple plugin instances, each with its own webhook and sender settings.

Notifications currently include `@everyone`. The plugin only listens for new tickets; replies and status changes do not trigger notifications.

## Requirements

- An osTicket installation with support for plugin instances.
- Administrator access to osTicket and access to its plugin directory.
- The PHP cURL extension enabled for the PHP installation running osTicket.
- A Discord webhook for the destination channel.
- Outbound HTTPS access from your osTicket server to Discord.

## Installation

1. Download this repository using **Code → Download ZIP**, then extract it.
2. Create a directory named `discord` inside your osTicket installation's `include/plugins/` directory.
3. Copy `config.php`, `discord.php`, and `plugin.php` into that directory:

   ```text
   include/
   └── plugins/
       └── discord/
           ├── config.php
           ├── discord.php
           └── plugin.php
   ```

   Keep the directory name exactly `discord` so it matches the plugin ID.

4. In osTicket, open **Admin Panel → Manage → Plugins**.
5. Choose **Add New Plugin**, select **OSTicket2Discord**, and install it.
6. Enable the plugin if it is not already enabled.

![Installing the Discord notifier plugin in osTicket](https://github.com/user-attachments/assets/3bad3e2c-6ce3-4009-ab14-d3055a572871)

## Configuration

Create a webhook for your chosen Discord channel and copy its webhook URL. In osTicket, open the installed plugin and create a new instance with these settings:

| Setting | Required | Description |
| --- | --- | --- |
| **Discord Webhook URL** | Yes | The webhook URL for the channel that should receive notifications. |
| **Discord Username** | No | The sender name displayed in Discord. Defaults to `osTicket` when left blank. |
| **Avatar URL** | No | A full HTTPS URL to an avatar image. A 128 × 128 PNG is recommended. |

Save your settings and enable the instance. To send notifications to additional channels, create another enabled instance for each channel's webhook. Every enabled instance receives new-ticket notifications.

![Creating a Discord notifier instance in osTicket](https://github.com/user-attachments/assets/e5fa94ae-93d8-4dc6-af26-51efad92a80d)

## Test the plugin

Create a test ticket in osTicket, then check the configured Discord channel. The notification uses this format:

```text
@everyone
New Ticket!
Subject: Unable to sign in
From: Jane Example (jane@example.com)
ID: 123
```

The ID is osTicket's internal ticket ID, which may differ from the ticket number shown to users.

![Example new-ticket notification in Discord](https://github.com/user-attachments/assets/4357be42-99bb-4435-b7f4-49ff1a7cd41c)

## Troubleshooting

- **Plugin does not appear:** Check that all three PHP files are directly inside `include/plugins/discord/`, with no extra nested directory, and are readable by your web server.
- **No notification arrives:** Confirm that both the plugin and its instance are enabled, check the webhook URL, and create a new ticket to test again.
- **Still no notification:** Verify that PHP cURL is enabled and that the server can reach Discord over HTTPS. Check your server's PHP error logs for runtime errors. The plugin does not currently log Discord delivery failures by default.
- **Duplicate notifications:** Check whether multiple enabled instances use webhooks that post to the same channel.

## Notification content

Each notification shares the requester's name and email address with the destination channel and includes an `@everyone` mention. Choose a channel appropriate for that information. The mention and message format are defined in `discord.php`; they are not configurable through the plugin settings.
