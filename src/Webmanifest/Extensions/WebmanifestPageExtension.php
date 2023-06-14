<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;
use Kraftausdruck\Webmanifest\Webmanifest;


class WebmanifestPageExtension extends Extension
{
    public function contentControllerInit($controller)
    {
        Requirements::insertHeadTags('<link rel="manifest" href="/site.webmanifest">');

        if ($this->webmanifest_theme_color()) {
            Requirements::insertHeadTags('<meta name="theme-color" content="' . $this->webmanifest_theme_color() . '">');
        }
    }

    public function webmanifest_theme_color()
    {
        $theme_color = '';

        if ($SiteConfig = SiteConfig::current_site_config()) {
            if ($SiteConfig->WebmanifestThemeColor && $SiteConfig->WebmanifestThemeColor != 'SiteConfig') {
                $theme_color = $SiteConfig->WebmanifestThemeColor;
            }
        }

        if (!$theme_color) {
            $theme_color = Config::inst()->get(Webmanifest::class, 'theme_color');
        }

        return $theme_color;
    }
}
