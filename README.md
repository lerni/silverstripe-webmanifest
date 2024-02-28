# Silverstripe site.webmanifest

This module provides [site.webmanifest](https://developer.mozilla.org/en-US/docs/Web/Manifest) for Silverstripe. Values are configurable via YAML or within SiteConfig in the CMS. YAML configuration (static) and values from SiteConfig (dynamic CMS) can be combined.

## Installation

Composer is the recommended way of installing Silverstripe modules.

```
composer require lerni/silverstripe-webmanifest
```

## Requirements

-   silverstripe/framework ^4 || ^5
-   silverstripe/siteconfig ^4 || ^5

### Suggested

-   jonom/silverstripe-text-target-length ^2
-   tractorcow/silverstripe-colorpicker ^4

## Configuration

You can set via yml-config what's in the manifest's json. With 'SiteConfig' as value, properties are editable per SiteConfig in CMS (dev/build needed). Alternatively, they can be set to other SiteConfig values like 'SiteConfig.Title'. If `lang` isn't specifically set, `i18n::get_locale()` will be used. With the default config (below), `name` is set to the value from `SiteConfig.Title`, for `short_name` a field is automatically added to SiteConfig. Further webmanifest values can be added as strings or arrays. See the full list of settings [W3C](https://w3c.github.io/manifest/#webappmanifest-dictionary). If `Page` (CMS-Module) exists, the manifest will be linked with a header-tag (`<link rel="manifest" href="/site.webmanifest">`) and also theme-color (`<link rel="manifest" href="/site.webmanifest">`) will be set if it has a value.

```yaml
Kraftausdruck\Webmanifest\Webmanifest:
  tab: 'Root.Webmanifest'
  fields:
    name: 'SiteConfig.Title' # max. 30 characters
    short_name: 'SiteConfig' # max. 12 characters
    description: 'SiteConfig.Tagline' # max. 132 characters
    start_url: '/'
    background_color: '#ffffff'
    theme_color: '#ffffff'
    icons:
      - src: '/icon-192.png'
        sizes: '192x192'
        type: 'image/png'
      - src: '/icon-512.png'
        sizes: '512x512'
        type: 'image/png'
```
