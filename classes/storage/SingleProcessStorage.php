<?php

namespace bandwidthThrottle\tokenBucket\storage;

use bandwidthThrottle\tokenBucket\lock\NoMutex;

/**
 * In-memory token storage which is only used for one single process.
 *
 * This storage is not shared among processes and therefore needs no locking.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license WTFPL
 */
class SingleProcessStorage implements Storage
{
 
    /**
     * @var Mutex The mutex.
     */
    private $mutex;
    
    /**
     * @var float The microtime.
     */
    private $microtime;
    
    /**
     * Initialization.
     */
    public function __construct()
    {
        $this->mutex = new NoMutex();
    }
    
    public function getMicrotime()
    {
        return $this->microtime;
    }

    public function isUninitialized()
    {
        return is_null($this->microtime);
    }

    public function setMicrotime($microtime)
    {
        $this->microtime = $microtime;
    }

    /**
     * Returns a non locking mutex.
     *
     * This storage doesn't need a mutex at all.
     *
     * @return NoMutex The non locking mutex.
     */
    public function getMutex()
    {
        return $this->mutex;
    }
}