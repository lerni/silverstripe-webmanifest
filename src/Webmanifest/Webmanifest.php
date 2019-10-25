<?php

namespace Kraftausdruck\Webmanifest;

use SilverStripe\i18n\i18n;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Webmanifest
 * Provides site.webmanifest functionality
 *
 * @package silverstripe-webmanifest
 */
class Webmanifest extends Controller
{
    /**
     * Generates the response containing the site.webmanifest content
     *
     * @return HTTPResponse
     */
    public function index()
    {
        return HTTPResponse::create(
            json_encode($this->WebmanifestArray()),
            200
        )
        ->addHeader(
            'Content-Type',
            'application/manifest+json; charset="utf-8"'
        );
    }

    public static function WebmanifestFieldsConfig() {
        $config = self::config()->get('fields');
        $configkeys = array_keys($config);
        $dbfields = [];
        $i = 0;
        foreach($configkeys as $key) {
            $dbfields[$i]['Webmanifest'] = $key;
            $dbfields[$i]['ConfigValue'] = $config[$key];
            $dbfields[$i]['SiteConfigField'] = 'Webmanifest' . Webmanifest::camelize($key);
            $i++;
        }
        return $dbfields;
    }

    public function WebmanifestArray()
    {
        $mergedResult = [];
        $currentSiteConfig = SiteConfig::current_site_config();

        foreach($this->WebmanifestFieldsConfig() as $item) {
            $webmanifestkey = $item['Webmanifest']; 
            if($item['ConfigValue'] == 'SiteConfig') {
                $webmanifestvalue = $item['SiteConfigField'];
                if ($value = $currentSiteConfig->{$webmanifestvalue}) {
                    $mergedResult[$webmanifestkey] = $value;
                }
            } elseif(!is_array($item['ConfigValue']) && substr($item['ConfigValue'], 0, 10 ) === 'SiteConfig') {
                $potentialFieldArr = explode('.', $item['ConfigValue']);
                if ($currentSiteConfig->hasField($potentialFieldArr[1]) && $currentSiteConfig->getField($potentialFieldArr[1])) {
                    $mergedResult[$webmanifestkey] = $currentSiteConfig->getField($potentialFieldArr[1]);
                }
            } elseif($item['ConfigValue']) {
                $mergedResult[$webmanifestkey] = $item['ConfigValue'];
            }
        }

        if(!array_key_exists('lang', $mergedResult)) {
            $mergedResult['lang'] = substr(i18n::get_locale(), 0, 2);
        }

        return $mergedResult;
    }

    public static function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
