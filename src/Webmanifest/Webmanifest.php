<?php

namespace Kraftausdruck\Webmanifest;

use SilverStripe\Dev\Debug;
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
     * @var string
     */
    private static $name = '';

    /**
     * @var string
     */
    private static $short_name = '';

    /**
     * @var string
     */
    private static $start_url = '.';

    /**
     * @var string
     */
    private static $display = '';

    /**
     * @var string
     */
    private static $background_color = '';

    /**
     * @var string
     */
    private static $theme_color = '';

    /**
     * @var string
     */
    private static $description = '';

    /**
     * @var string|array
     */
    private static $platform = '';

    /**
     * @var string
     */
    private static $url = '';

    /**
     * @var array
     */
    private static $icons = [];

    /**
     * @var array
     */
    private static $related_applications = [];

//     private static $casting = [];

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
        $fieldResult = [];
        $currentSiteConfig = SiteConfig::current_site_config();

        foreach($this->WebmanifestFieldsConfig() as $item) {
            $webmanifestkey = $item['Webmanifest']; 
            if($item['ConfigValue'] == 'SiteConfig') {
                $webmanifestvalue = $item['SiteConfigField'];
                if ($value = $currentSiteConfig->{$webmanifestvalue}) {
                    $fieldResult[$webmanifestkey] = $value;
                }
            } elseif(substr($item['ConfigValue'], 0, 10 ) === 'SiteConfig') {
                $potentialFieldArr = explode('.', $item['ConfigValue']);
                if ($currentSiteConfig->hasField($potentialFieldArr[1]) && $currentSiteConfig->getField($potentialFieldArr[1])) {
                    $fieldResult[$webmanifestkey] = $currentSiteConfig->getField($potentialFieldArr[1]);
                }
            } elseif($item['ConfigValue']) {
                $fieldResult[$webmanifestkey] = $item['ConfigValue'];
            }
        }
        $iconConfig['icons'] = self::config()->get('icons');

        $mergedResult = array_merge($fieldResult, $iconConfig);

         return $mergedResult;
    }

    public static function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
