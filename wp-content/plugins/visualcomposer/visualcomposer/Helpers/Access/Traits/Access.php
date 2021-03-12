<?php

namespace VisualComposer\Helpers\Access\Traits;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Application;
use VisualComposer\Helpers\Nonce;

/**
 * Class Access.
 */
trait Access
{
    /**
     * @var bool
     */
    protected $validAccess = true;

    /**
     * @return bool
     */
    public function getValidAccess()
    {
        return $this->validAccess;
    }

    /**
     * @param mixed $validAccess
     *
     * @return $this
     */
    public function setValidAccess($validAccess)
    {
        $this->validAccess = $validAccess;

        return $this;
    }

    /**
     * Check multi access settings by method inside class object.
     *
     * @param $callback callable
     * @param $valid
     * @param $argsList
     *
     * @return $this
     */
    public function checkMulti($callback, $valid, $argsList)
    {
        if ($this->getValidAccess()) {
            $access = !$valid;
            /** @var Application $vcapp */
            $vcapp = vcapp();
            foreach ($argsList as $args) {
                if (!is_array($args)) {
                    $args = [$args];
                }
                $this->setValidAccess(true);
                $vcapp->call($callback, $args);
                if ($valid === $this->getValidAccess()) {
                    $access = $valid;
                    break;
                }
            }
            $this->setValidAccess($access);
        }

        return $this;
    }

    /**
     * Get current validation state and reset it to true. ( should be never called twice ).
     *
     * @param bool $reset
     *
     * @return bool
     */
    public function get($reset = true)
    {
        $result = $this->getValidAccess();
        if ($reset) {
            $this->reset();
        }

        return $result;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->setValidAccess(true);

        return $this;
    }

    /**
     * Call die() function with message if access is invalid.
     *
     * @param string $message
     *
     * @return $this
     * @throws \Exception
     */
    public function validateDie($message = '')
    {
        $result = $this->getValidAccess();
        $this->setValidAccess(true);
        if (!$result) {
            if (defined('VCV_DIE_EXCEPTION') && VCV_DIE_EXCEPTION) {
                throw new \Exception($message);
            } else {
                die(esc_html($message));
            }
        }

        return $this;
    }

    /**
     * @param $func
     *
     * @return $this
     */
    public function check($func)
    {
        if ($this->getValidAccess()) {
            $args = func_get_args();
            $args = array_slice($args, 1);
            /** @var Application $vcapp */
            $vcapp = vcapp();
            $this->setValidAccess($vcapp->call($func, $args));
        }

        return $this;
    }

    /**
     * Any of provided rules should be valid.
     *
     * @return $this
     */
    public function checkAny()
    {
        if ($this->getValidAccess()) {
            $args = func_get_args();
            $this->checkMulti([$this, 'check'], true, $args);
        }

        return $this;
    }

    /**
     * All provided rules should be valid.
     *
     * @return $this
     */
    public function checkAll()
    {
        if ($this->getValidAccess()) {
            $args = func_get_args();
            $this->checkMulti([$this, 'check'], false, $args);
        }

        return $this;
    }

    /**
     * @param string $nonce
     *
     * @return $this
     */
    public function checkAdminNonce($nonce = '')
    {
        /** @var Nonce $nonceHelper */
        $nonceHelper = vchelper('Nonce');

        /** @see \VisualComposer\Helpers\Nonce::verifyAdmin */
        return $this->check([$nonceHelper, 'verifyAdmin'], $nonce);
    }

    /**
     * @param string $nonce
     *
     * @return $this
     */
    public function checkPublicNonce($nonce = '')
    {
        /** @var Nonce $nonceHelper */
        $nonceHelper = vchelper('Nonce');

        /** @see \VisualComposer\Helpers\Nonce::verifyUser */
        return $this->check([$nonceHelper, 'verifyUser'], $nonce);
    }
}
