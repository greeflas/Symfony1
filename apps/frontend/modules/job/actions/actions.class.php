<?php

/**
 * Job controller.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Vladimir Kuprienko
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
    /**
     * Renders list of job opportunities.
     *
     * @param sfWebRequest $request
     * @throws Doctrine_Query_Exception
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->jobeet_jobs = Doctrine_Core::getTable('JobeetJob')
          ->createQuery('a')
          ->execute();
    }

    /**
     * Show details about job opportunity.
     *
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->job = $this->getRoute()->getObject();
    }

    /**
     * Renders form for creating of new job opportunity.
     *
     * @param sfWebRequest $request
     * @throws sfException
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm();
    }

    /**
     * Process data from create form.
     *
     * @param sfWebRequest $request
     * @throws sfError404Exception
     * @throws sfException
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new JobeetJobForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Renders form for updating of job opportunity.
     *
     * @param sfWebRequest $request
     * @throws sfError404Exception
     * @throws sfException
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
        $this->form = new JobeetJobForm($jobeet_job);
    }

    /**
     * Proccess data from update form.
     *
     * @param sfWebRequest $request
     * @throws sfError404Exception
     * @throws sfException
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
        $this->form = new JobeetJobForm($jobeet_job);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Delete job opportunity.
     *
     * @param sfWebRequest $request
     * @throws sfError404Exception
     * @throws sfStopException
     * @throws sfValidatorErrorSchema
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
        $jobeet_job->delete();

        $this->redirect('job/index');
    }

    /**
     * Process form common method.
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     * @throws sfStopException
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $jobeet_job = $form->save();

            $this->redirect('job/edit?id='.$jobeet_job->getId());
        }
    }
}
