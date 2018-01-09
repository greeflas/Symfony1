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
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->categories = Doctrine_Core::getTable('JobeetCategory')->getWithJobs();
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
     * @throws Doctrine_Connection_Exception
     * @throws Doctrine_Record_Exception
     * @throws sfException
     */
    public function executeNew(sfWebRequest $request)
    {
        $job = new JobeetJob();
        $job->setType('full-time');

        $this->form = new JobeetJobForm($job);
    }

    /**
     * Process data from create form.
     *
     * @param sfWebRequest $request
     * @throws sfException
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    /**
     * Renders form for updating of job opportunity.
     *
     * @param sfWebRequest $request
     * @throws sfException
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm($this->getRoute()->getObject());
    }

    /**
     * Proccess data from update form.
     *
     * @param sfWebRequest $request
     * @throws sfException
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm($this->getRoute()->getObject());
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    /**
     * Delete job opportunity.
     *
     * @param sfWebRequest $request
     * @throws sfStopException
     * @throws sfValidatorErrorSchema
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRoute()->getObject();
        $job->delete();

        $this->redirect('job/index');
    }

    /**
     * Publish job for users.
     *
     * @param sfWebRequest $request
     * @throws sfStopException
     * @throws sfValidatorErrorSchema
     */
    public function executePublish(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRoute()->getObject();
        $job->publish();

        $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

        $this->redirect('job_show_user', $job);
    }

    /**
     * Extend job expires date.
     *
     * @param sfWebRequest $request
     * @throws sfError404Exception
     * @throws sfStopException
     * @throws sfValidatorErrorSchema
     */
    public function executeExtend(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRequest()->getObject();
        $this->forward404Unless($job->extend());

        $this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getDateTimeObject('expires_at')->format('m/d/Y')));

        $this->redirect('job_show_user', $job);
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
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );

        if ($form->isValid())
        {
            $job = $form->save();

            $this->redirect('job_show', $job);
        }
    }
}
