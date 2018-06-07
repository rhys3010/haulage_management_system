<?php
/**
  * Haulage Management System - FeedbackController.php
  *
  * The controller class for the feedback submission view.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class FeedbackController extends Controller {

  /**
    * Render the feedback form view
    * @param request - The request object
    * @param response - The response object
  */
  public function getFeedback($request, $response){
    $this->container->view->render($response, 'feedback.twig');
  }

  /**
    * Handle the feedback form submission, validation, submission and logging
    * @param request - The request object
    * @param response - The response object
    * @return response - Redirected response to feedback page
  */
  public function postFeedback($request, $response){

    // Validate the form
    $validation = $this->validator->validate($request, [

      'subject' => v::notEmpty()->length(2, 255),
      'feedback-type' => v::notEmpty(),
      'message' => v::notEmpty()->length(5, 255),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('feedback'));
    }

    // SEND FEEDBACK (phpmailer stuff)
    $user = User::find($_SESSION['user'])->username;

    $feedbackBody = "<p>New Feedback Received, Details Below: </p>
                    <p><strong>User: </strong> {$user} </p>
                    <p><strong>Feedback Type: </strong> {$request->getParam('feedback-type')} </p>
                    <p><strong>Subject: </strong> {$request->getParam('subject')} </p>
                    <p><strong>Subject: </strong> {$request->getParam('message')} </p>";


    $this->container->mailer->setFrom($this->container->settings['mail']['username'], 'Feedback From Haulage Management System');
    $this->container->mailer->addAddress($this->container->settings['mail']['recipient']);
    $this->container->mailer->isHTML(true);

    $this->container->mailer->Subject = "Feedback From Haulage Management System";
    $this->container->mailer->Body = $feedbackBody;

    $this->container->mailer->send();

    // Success behaviour
    $_SESSION['success'] = 'Feedback Submitted. Thank you for getting in touch!';
    unset($_SESSION['old']);

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' submitted a feedback form.';
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    return $response->withRedirect($this->router->pathFor('feedback'));
  }

}

?>
