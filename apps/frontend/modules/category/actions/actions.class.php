<?php

/**
 * Category controller.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Vladimir Kuprienko
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends sfActions
{
    /**
     * Show categories list.
     *
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request)
    {
        $category = $this->getRoute()->getObject();

        $pager = new sfDoctrinePager('JobeetJob', sfConfig::get('app_max_jobs_on_category'));
        $pager->setQuery($category->getActiveJobsQuery());
        $pager->setPage($request->getGetParameter('page', 1));
        $pager->init();

        $this->category = $category;
        $this->pager = $pager;

        if ('json' === $request->getRequestFormat()) {
            $this->latestPost = $category->getLatestPost();
        }
    }
}
