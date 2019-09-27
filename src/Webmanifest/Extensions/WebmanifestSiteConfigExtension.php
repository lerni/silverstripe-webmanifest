<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Config\Config;
use Kraftausdruck\Webmanifest\Webmanifest;
use TractorCow\Colorpicker\Forms\ColorField;
use JonoM\SilverStripeTextTargetLength\TextTargetLengthExtension;

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
        $tab = Config::inst()->get('Kraftausdruck\Webmanifest\Webmanifest', 'tab');

        foreach ($manifestFields as $field) {
            $SiteConfigField = $field['SiteConfigField'];
            $SiteConfigFieldLable = $field['Webmanifest'];

            if ($field['ConfigValue'] == 'SiteConfig') {

                if (in_array($SiteConfigFieldLable, ['theme_color', 'background_color']) && class_exists(ColorField::class)) {
                    $field = ColorField::create($SiteConfigField, $SiteConfigFieldLable);
                } else {
                    $field = TextField::create($SiteConfigField, $SiteConfigFieldLable);
                }

                if ($SiteConfigFieldLable == 'name' && class_exists(TextTargetLengthExtension::class)) {
                    $field->setTargetLength(45, 20, 45);
                }
                if ($SiteConfigFieldLable == 'short_name' && class_exists(TextTargetLengthExtension::class)) {
                    $field->setTargetLength(12, 5, 12);
                }

                $fields->addFieldToTab(
                    $tab,
                    $field
                );
            }
        }
    }
}