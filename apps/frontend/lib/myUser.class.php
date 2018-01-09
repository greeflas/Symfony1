<?php

/**
 * User class for frontend application.
 */
class myUser extends sfBasicSecurityUser
{
    /**
     * Write job to view history.
     *
     * @param int $jobId
     */
    public function addJobToHistory($jobId)
    {
        $IDs = $this->getAttribute('job_history', []);

        if (!in_array($jobId, $IDs)) {
            array_unshift($IDs, $jobId);
            $this->setAttribute('job_history', array_slice($IDs, 0, 3));
        }
    }

    /**
     * Returns viewed jobs history.
     *
     * @return array|Doctrine_Collection
     * @throws Doctrine_Query_Exception
     */
    public function getJobHistory()
    {
        $IDs = $this->getAttribute('job_history', []);

        if (!empty($IDs)) {
            return Doctrine_Core::getTable('JobeetJob')
                ->createQuery('a')
                ->whereIn('a.id', $IDs)
                ->execute()
            ;
        }

        return [];
    }

    /**
     * Reset viewed jobs history.
     */
    public function resetJobHistory()
    {
        $this->getAttributeHolder()->remove('job_history');
    }
}
