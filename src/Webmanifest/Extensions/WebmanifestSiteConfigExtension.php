<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Config\Config;
use Kraftausdruck\Webmanifest\Webmanifest;

class WebmanifestSiteConfigExtension extends DataExtension
{

    static function add_to_class($class, $extensionClass, $args = null)
    {

        $db = [];
        $manifestFields = Webmanifest::WebmanifestFieldsConfig();

        foreach ($manifestFields as $field) {
            if ($field['ConfigValue'] == 'SiteConfig') {
                $SiteConfigField = $field['SiteConfigField'];
                $db[$SiteConfigField] = 'Varchar(255)';
            }
        }

        Config::inst()->update($class, 'db', $db);
        // parent::add_to_class($class, $extensionClass, $args);
    }  

    public function updateCMSFields(FieldList $fields)
    {
        $manifestFields = Webmanifest::WebmanifestFieldsConfig();
        $tab = 'Root.Webmanifest';

        foreach ($manifestFields as $field) {
            $SiteConfigField = $field['SiteConfigField'];
            $SiteConfigFieldLable = $field['Webmanifest'];
            if ($field['ConfigValue'] == 'SiteConfig') {
                $fields->addFieldToTab(
                    $tab,
                    TextField::create($SiteConfigField, $SiteConfigFieldLable)
                );
            }
        }
    }
}