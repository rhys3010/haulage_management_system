<?php
/**
  * Haulage Management System - ChangelogController.php
  *
  * The controller class for the Changelog view.
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

use \Slim\Views\Twig as View;


class ChangelogController extends Controller {

  /**
    * Render the changelog view
    * @param request - The request object
    * @param response - The response object
  */
  public function getChangelog($request, $response){
    $this->container->view->render($response, 'changelog.twig');
  }
}

?>
