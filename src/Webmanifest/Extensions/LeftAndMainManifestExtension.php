<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

class LeftAndMainManifestExtension extends Extension
{
    public function onBeforeInit()
    {
        Requirements::insertHeadTags('<link rel="manifest" href="/site.webmanifest">');
    }
}
