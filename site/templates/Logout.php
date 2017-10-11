<?php
if($user->isLoggedin()) {
  $session->logout();
  $session->message(__("Sie wurden erfolgreich abgemeldet!"));
}
$session->redirect($homepage->url());