# SilverStripe site.webmanifest
This module provides [site.webmanifest](https://developer.mozilla.org/en-US/docs/Web/Manifest) for Silverstripe. Values are configurable per YML or within SiteConfig in the CMS. Yml-config (static) and values from SiteConfig (dynamic) can be used to glue stuff from build tools and strings maintained per CMS.

## Installation
Composer is the recommended way of installing Silverstripe modules.
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
You can set per yml-config whats in the manifests json. With 'SiteConfig' as value, properties are editable per SiteConfig in CMS (dev/build needed). Alternatively they can be set to other SiteConfig values like 'SiteConfig.Title'. If `lang` isn't specifically set, `i18n::get_locale()` 'll be used. With the default config (bellow) `name` is set to the value from `SiteConfig.Title`, for `short_name` a field is automatically added to SiteConfig. Further webmanifest values can be added as strings or arrays. See the full list of settings [W3C](https://w3c.github.io/manifest/#webappmanifest-dictionary). If `Page` (CMS-Module) exist, the manifest 'll be linked with a Header-Tag (`<link rel="manifest" href="/site.webmanifest">`) and also theme-color (`<link rel="manifest" href="/site.webmanifest">`) 'll be set if it has a value.
```yaml
Kraftausdruck\Webmanifest\Webmanifest:
  tab: 'Root.Webmanifest'
  fields:
    name: 'SiteConfig.Title' # max. 30 charactes
    short_name: 'SiteConfig' # max. 12 charactes
    description: 'SiteConfig.Tagline' # max. 132 charactes
    start_url: '/'
    background_color: '#ffffff'
    theme_color: '#ffffff'
    icons:
      - src: '/icon-192.png'
        sizes: '192x192'
        type: 'image/png'
      - src: '/icon-384.png'
        sizes: '384x384'
        type: 'image/png'
      - src: '/icon-512.png'
        sizes: '512x512'
        type: 'image/png'
```