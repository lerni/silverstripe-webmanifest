<?php

namespace Kraftausdruck\Webmanifest\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;


class WebmanifestPageExtension extends Extension
{
    public function contentControllerInit($controller)
    {
        Requirements::insertHeadTags('<link rel="manifest" href="/site.webmanifest">');
    }
}
