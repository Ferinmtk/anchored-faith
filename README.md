<div align="center">

# ⚓ An Anchored Faith

**A custom WordPress plugin that builds the whole [An Anchored Faith](https://ananchoredfaith.com) site from shortcodes.**

![Version](https://img.shields.io/badge/version-4.0.0-1f3a5f)
![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b?logo=wordpress&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-plugin-777bb4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)

[Live site](https://ananchoredfaith.com) · [YouTube channel](https://www.youtube.com/@ananchoredfaith) · [Shortcodes](#-shortcodes) · [Installation](#-installation)

</div>

---

## ✨ Overview

An Anchored Faith is a faith and gospel-study site. This plugin supplies the homepage and the About, General Conference, Kids and Podcast pages. Each section is a shortcode, so a page is built by stacking shortcodes in the WordPress editor. No page builder is needed.

## 🧩 Features

| | |
|---|---|
| 🎞️ **Hero slider** | Animated bxSlider hero with an announcement bar and a scrolling marquee ticker |
| 🧭 **Homepage sections** | Faith pathways, video gallery, resources, featured scripture |
| 🏛️ **General Conference** | Session schedule, how to watch, how to prepare |
| 🧒 **Kids & families** | Age groups, activities, featured content, resources, a note for parents |
| 🎙️ **Podcast** | Show intro, episode list, where to listen |
| 🔊 **Listen player** | Reads a post aloud using the browser's built-in text-to-speech (Chrome and Edge) |
| 🦶 **Site footer** | Added to every page automatically |
| ⚡ **Performance** | Scripts load deferred in the footer, so they don't block rendering; animations run on scroll |

## 📦 Installation

1. Get the plugin zip. It must unzip to a folder named **`anchored-faith-slider/`**.
2. In WordPress, go to **Plugins → Add New → Upload Plugin**, choose the zip, and click **Activate**.
3. Add shortcodes to your pages (see below).

> [!IMPORTANT]
> Don't install from GitHub's **Code → Download ZIP** as-is. That zip unzips to `anchored-faith-main/`, so WordPress treats it as a second, separate plugin. Rename the folder to `anchored-faith-slider` and re-zip it first.

**Requirements:** WordPress 5.0+ and jQuery (loaded by most themes).

## 🔖 Shortcodes

None of the shortcodes take attributes; add them as written. Stack them in order to build each page.

### 🏠 Homepage

```text
[af_hero_slider]
[af_marquee]
[af_pathways]
[af_videos]
[af_resources]
[af_scripture]
[af_centered]
```

### 👋 About

```text
[af_about_hero]
[af_about_who]
[af_about_what]
[af_about_why]
[af_about_belief]
[af_about_cta]
```

### 🏛️ General Conference

```text
[af_conf_hero]
[af_conf_what]
[af_conf_schedule]
[af_conf_watch]
[af_conf_prepare]
```

### 🧒 Kids

```text
[af_kids_hero]            [af_kids_hero_v2]
[af_kids_ages]
[af_kids_activities]
[af_kids_featured]
[af_kids_resources]       [af_kids_resources_v2]
[af_kids_why]             [af_kids_why_v2]
[af_kids_parents_v2]
[af_kids_verse]
```

> [!NOTE]
> Sections with a `_v2` version come in two designs. Use one of each pair, not both.

### 🎙️ Podcast

```text
[af_pod_hero]
[af_pod_about]
[af_pod_episodes]
[af_pod_where]
```

### 📝 Posts and site-wide

| Shortcode | What it does |
|---|---|
| `[af_listen]` | Adds a Listen button that reads the post aloud |
| `[af_footer]` | Site footer. **Already added to every page automatically**, so adding it to a page shows it twice. |

## 🗂️ Project structure

```text
anchored-faith-slider/
├── bliksem-simple-slider.php   # plugin bootstrap, shortcodes and section styles
├── css/
│   ├── anchored-hero.css
│   ├── bxslider.css
│   ├── bx_slider_css.min.css
│   └── fonts/
├── js/
│   ├── anchored-hero.js        # hero slider and scroll animations
│   ├── bxslider.js             # bxSlider 4.2.1
│   └── rx.js                   # older slider setup, not loaded
└── Example.html
```

## 🛠️ Built with

PHP · WordPress Shortcode API · jQuery · bxSlider · CSS

## 👤 Author

**Ferrin Mutuku** · [github.com/Ferinmtk](https://github.com/Ferinmtk)

## 📄 License

GPL v2 or later. bxSlider is MIT-licensed.
