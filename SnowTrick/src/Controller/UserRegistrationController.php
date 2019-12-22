<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class UserRegistrationController
{
  public function index(): Response
  {
    return new Response ('Form registration inc');
  }
}

?>
