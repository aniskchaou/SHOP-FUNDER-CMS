<?php

namespace VisualComposer\Modules\Hub;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Module;
use VisualComposer\Helpers\Filters;
use VisualComposer\Helpers\Options;
use VisualComposer\Helpers\Traits\EventsFilters;

class DownloadController extends Container implements Module
{
    use EventsFilters;

    public function __construct()
    {
        if (vcvenv('VCV_ENV_EXTENSION_DOWNLOAD')) {
            $this->addFilter('vcv:hub:process:action:element/*', 'processAction');
            $this->addFilter('vcv:hub:process:action:addon/*', 'processAction');
            $this->addFilter('vcv:hub:process:action:asset/*', 'processAction');

            // templates
            $this->addFilter('vcv:hub:process:action:predefinedTemplate/*', 'processAction');
            $this->addFilter('vcv:hub:process:action:template/*', 'processAction');

            $this->addFilter('vcv:ajax:editors:agreeHubTerms:enable:adminNonce', 'sendAgreeHubTerms');
        }
    }

    protected function processAction($response, $payload, Filters $filterHelper)
    {
        if (!vcIsBadResponse($response) && $payload['data']) {
            $hubHelper = vchelper('HubActionsActionBundle');
            /** @var $hubHelper \VisualComposer\Helpers\Hub\Bundle */
            $hubHelper->setTempBundleFolder(
                VCV_PLUGIN_ASSETS_DIR_PATH . '/temp-bundle-' . str_replace('/', '-', $payload['action'])
            );
            $hubHelper->removeTempBundleFolder();
            $archive = $hubHelper->requestBundleDownload($payload['data']['url']);
            if (!vcIsBadResponse($archive)) {
                $archive = $this->readBundleJson($archive, $payload);
                $response['status'] = $archive !== false;
                if ($archive) {
                    $response = $filterHelper->fire(
                        'vcv:hub:download:bundle:' . $payload['action'],
                        $response,
                        ['archive' => $archive, 'actionData' => $payload],
                        true
                    );
                }
            } else {
                return false;
            }
            $removeResult = $hubHelper->removeTempBundleFolder();
            if (vcIsBadResponse($removeResult)) {
                return false;
            }
        }

        return $response;
    }

    protected function readBundleJson($archive, $payload)
    {
        $hubHelper = vchelper('HubActionsActionBundle');
        $loggerHelper = vchelper('Logger');

        /** @var \VisualComposer\Helpers\Hub\Bundle $hubHelper */
        $result = $hubHelper->unzipDownloadedBundle($archive);
        if (vcIsBadResponse($result)) {
            return false;
        }

        if (isset($payload['checksum']) && !empty($payload['checksum'])) {
            $mdOriginalFile = md5_file($archive);
            if ($mdOriginalFile !== $payload['checksum']) {
                $loggerHelper->log(
                    sprintf(
                        __(
                            'A .zip file of the Visual Composer is broken - the checksum check failed. Check your Internet connection, initiate reset under Visual Composer Settings, and try again.

If the problem still occurs, visit %smy.visualcomposer.com/support%s for technical assistance.
',
                            'visualcomposer'
                        ),
                        sprintf(
                            '<a href="%s" target="_blank" rel="noopener noreferrer">',
                            str_replace('utm_content=button', 'utm_content=text', vcvenv('VCV_SUPPORT_URL'))
                        ),
                        '</a>'
                    )
                );

                return false;
            }
        }

        return $hubHelper->readBundleJson($hubHelper->getTempBundleFolder('bundle.json'));
    }

    /**
     * Agree to the hub terms
     *
     * @param \VisualComposer\Helpers\Options $optionsHelper
     *
     * @return array
     */
    protected function sendAgreeHubTerms(Options $optionsHelper)
    {
        $optionsHelper->set('agreeHubTerms', time());
        $optionsHelper->deleteTransient('lastBundleUpdate');

        return ['status' => true];
    }
}
