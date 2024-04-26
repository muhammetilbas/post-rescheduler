# Reschedule Post Plugin

## Description
The Reschedule Post plugin allows users to reschedule WordPress posts by specifying a custom date and time for publication.

## Features
- Adds a custom date and time field in the post editor screen for rescheduling posts.
- Automatically updates the publication date of posts based on the custom date and time set by the user.
- Provides a cron job to check for posts that need to be rescheduled at regular intervals.

## Usage
1. After activating the plugin, navigate to the WordPress post editor.
2. In the post editor sidebar, you will find a "Custom Reschedule" meta box.
3. Enter the desired date and time for rescheduling the post using the provided input field.
4. Save or update the post.
5. The plugin will automatically update the post's publication date based on the specified custom date and time.

## SEO Benefits
- SEO-conscious users can utilize the Reschedule Post plugin to strategically schedule post updates, ensuring content remains fresh and relevant for search engines.
- By regularly updating publication dates, users can signal to search engines that their content is current and actively maintained, potentially improving search rankings and visibility.
- Scheduled updates can help maintain a consistent publishing schedule, which is beneficial for SEO by encouraging search engine crawlers to visit the site more frequently for fresh content.

## Developer Notes
- The plugin uses WordPress meta fields to store the custom reschedule date and time.
- A cron job is set up to periodically check for posts that need to be rescheduled.
- Custom cron schedules are added to enable more frequent checks if necessary.

## Contributors
- [@muhammetilbas](https://github.com/muhammetilbas)

Feel free to contribute to this project by forking the repository and submitting pull requests!

## License
This plugin is released under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html) license.
