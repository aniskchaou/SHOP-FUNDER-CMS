<?php

namespace VisualComposer\Helpers\Hub\Actions;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Illuminate\Support\Helper;
use VisualComposer\Helpers\Hub\Bundle;

class ActionBundle extends Bundle implements Helper
{
    /** @noinspection PhpMissingParentCallCommonInspection */
    public function requestBundleDownload($url)
    {
        $fileHelper = vchelper('File');
        $downloadedArchive = $fileHelper->download($url);

        return $downloadedArchive;
    }
}
