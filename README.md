# SilverStripe site.webmanifest
This module provides a simple site.webmanifest for SilverStripe. Values are configurable per YML or within SiteConfig in the CMS.

## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require lerni/silverstripe-webmanifest
```

## Requirements

- silverstripe/framework ^4
- silverstripe/siteconfig ^4
- jonom/silverstripe-text-target-length ^2

## Configuration
You can add properties directly into yml-config or with 'SiteConfig' as value to have it editable per SiteConfig in CMS or set it to a different SiteConfig Value like 'SiteConfig.Title'.

```yaml
Kraftausdruck\Webmanifest\Webmanifest:
  fields:
    name: 'SiteConfig.Title'
    short_name: 'SiteConfig'
    start_url: ''
    display: 'standalone'
    background_color : '#fff'
    theme_color : '#fff'
    description: 'SiteConfig'
    platform: ''
    url: ''
    related_applications: ''
  icons:
    - src: '/android-chrome-192x192.png'
      sizes: '192x192'
      type: 'image/png'
    - src: '/android-chrome-384x384.png'
      sizes: '384x384'
      type: 'image/png'
```