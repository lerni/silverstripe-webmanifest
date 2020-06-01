<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use Kraftausdruck\Webmanifest\Webmanifest;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;


class WebmanifestPageExtension extends Extension
{
    public function contentControllerInit($controller)
    {
        Requirements::insertHeadTags('<link rel="manifest" href="/site.webmanifest">');
    }

    public function webmanifest_theme_color()
    {
        $theme_color = '';

        if ($SiteConfig = SiteConfig::current_site_config())
        {
            if ($SiteConfig->WebmanifestThemeColor && $SiteConfig->WebmanifestThemeColor != 'SiteConfig')
            {
                $theme_color = $SiteConfig->WebmanifestThemeColor;
            }
        }

        if (!$theme_color)
        {
            $theme_color = Config::inst()->get(Webmanifest::class, 'theme_color');
        }

        return $theme_color;

    }
}
