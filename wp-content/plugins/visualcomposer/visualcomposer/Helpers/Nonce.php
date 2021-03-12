<?php

namespace VisualComposer\Helpers;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Illuminate\Support\Helper;

/**
 * Class Nonce.
 */
class Nonce implements Helper
{
    /**
     * @return mixed
     */
    public function user()
    {
        return wp_create_nonce('vcv:nonce');
    }

    /**
     * @return mixed
     */
    public function admin()
    {
        return vchelper('AccessCurrentUser')->wpAll('edit_posts')->get() ? wp_create_nonce('vcv:nonce:admin') : false;
    }

    /**
     * @param $nonce
     *
     * @return bool
     */
    public function verifyUser($nonce)
    {
        return !empty($nonce) && wp_verify_nonce($nonce, 'vcv:nonce');
    }

    /**
     * @param $nonce
     *
     * @return bool
     */
    public function verifyAdmin($nonce)
    {
        return !empty($nonce) && vchelper('AccessCurrentUser')->wpAll('edit_posts')->get()
            && wp_verify_nonce(
                $nonce,
                'vcv:nonce:admin'
            );
    }

    /**
     * Create nonce for pageEditable url
     *
     * @return mixed
     */
    public function pageEditable()
    {
        return vchelper('AccessCurrentUser')->wpAll('edit_posts')->get() ? $this->createPageEditableNonce() : false;
    }

    /**
     * Verify pageEditable nonce
     *
     * @param $nonce
     *
     * @return bool
     */
    public function verifyPageEditable($nonce)
    {
        return !empty($nonce) && vchelper('AccessCurrentUser')->wpAll('edit_posts')->get()
            && $nonce === $this->createPageEditableNonce();
    }

    /**
     * Create nonce string for pageEditable
     *
     * @return string
     */
    protected function createPageEditableNonce()
    {
        $i = wp_nonce_tick();
        $nonceKey = get_option('nonce_key', '');
        $nonceSalt = get_option('nonce_salt', '');

        return substr(wp_hash($i . '|' . $nonceKey . '|' . $nonceSalt, 'pageEditable'), -12, 10);
    }
}
