# SilverStripe site.webmanifest
This module provides site.webmanifest for SilverStripe. Values are configurable per YML or within SiteConfig in the CMS. Yml-config (static) and values from SiteConfig (dynamic) can be used to glue stuff from build tools and strings maintained per SiteConfig.

## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require lerni/silverstripe-webmanifest
```

## Requirements
- silverstripe/framework ^4
- silverstripe/siteconfig ^4
### Suggested
- jonom/silverstripe-text-target-length ^2
- tractorcow/silverstripe-colorpicker ^4

## Configuration
You can add/modify properties in yml-config. With 'SiteConfig' as value they are editable per SiteConfig in CMS (dev/build needed). Alternatively properties can be set to other SiteConfig field values like 'SiteConfig.Title'. If `lang` isn't specifically set, the value 'll be set from `i18n::get_locale()`. With the default config (bellow) `name` is set to the value from `SiteConfig.Title`, for `short_name` a field is automatically added to SiteConfig. Further webmanifest values can be added like `background_color` or `icons` as strings or arrays. Check the full settings list [W3C](https://developer.mozilla.org/en-US/docs/Web/Manifest). The module doesn't add a Header-Tag to your HTML - you need to do this per `PHP` or in template.

```php
Requirements::insertHeadTags('<link rel="manifest" href="/site.webmanifest">');
```
```yaml
Kraftausdruck\Webmanifest\Webmanifest:
  fields:
    name: 'SiteConfig.Title'
    short_name: 'SiteConfig'
    description: 'SiteConfig.Tagline'
    start_url: '/home'
    background_color: '#fff'
    icons:
      - src: '/android-chrome-192x192.png'
        sizes: '192x192'
        type: 'image/png'
      - src: '/android-chrome-384x384.png'
        sizes: '384x384'
        type: 'image/png'
```