<?php

/**
  * Haulage Management System - Feedback Controller
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class FeedbackController extends Controller {

  public function getFeedback($request, $response){
    $this->container->view->render($response, 'feedback.twig');
  }

  public function postFeedback($request, $response){

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
