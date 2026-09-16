# An Anchored Faith — WordPress Plugin

Custom WordPress plugin for [An Anchored Faith](https://www.youtube.com/@ananchoredfaith), a faith and gospel-study site. Builds the homepage and the About, Conference, Kids and Podcast pages from shortcodes.

## Features

- Animated hero slider (bxSlider) with announcement bar and marquee ticker
- Faith pathways, video gallery, resources and scripture sections
- General Conference page: schedule, how to watch, how to prepare
- Kids & families page: age groups, activities, resources
- Podcast page with episode list
- Text-to-speech "Listen" player for posts
- Scroll-triggered animations; scripts deferred to avoid blocking render

## Installation

1. Zip this folder, or download the repo as a ZIP.
2. In WordPress: **Plugins → Add New → Upload Plugin**, upload, and activate.
3. Add shortcodes to your pages.

Requires WordPress 5.0+ and jQuery (loaded by most themes).

## Shortcodes

| Page | Shortcodes |
|---|---|
| Homepage | `[af_hero_slider]` `[af_marquee]` `[af_pathways]` `[af_videos]` `[af_resources]` `[af_scripture]` `[af_centered]` `[af_footer]` |
| About | `[af_about_hero]` `[af_about_who]` `[af_about_what]` `[af_about_why]` `[af_about_belief]` `[af_about_cta]` |
| Conference | `[af_conf_hero]` `[af_conf_what]` `[af_conf_schedule]` `[af_conf_watch]` `[af_conf_prepare]` |
| Kids | `[af_kids_hero]` `[af_kids_hero_v2]` `[af_kids_ages]` `[af_kids_activities]` `[af_kids_featured]` `[af_kids_resources]` `[af_kids_resources_v2]` `[af_kids_why]` `[af_kids_why_v2]` `[af_kids_parents_v2]` `[af_kids_verse]` |
| Podcast | `[af_pod_hero]` `[af_pod_about]` `[af_pod_episodes]` `[af_pod_where]` |
| Posts | `[af_listen]` |

## Stack

PHP · WordPress Shortcode API · jQuery · bxSlider · CSS

## Author

Ferrin Mutuku — [github.com/Ferinmtk](https://github.com/Ferinmtk)

## License

GPL v2 or later. bxSlider is MIT-licensed.
