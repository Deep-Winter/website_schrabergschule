<?php

/*
  Usage: Set the access control in the template of the secured page
  to 'yes'. Uncheck the guest access and set the redirect page to custom value:
  Redirect to another URL: /login/?r={id}
*/

if($user->isLoggedin()) {
    $content .= '<p class="text-center">Sie sind angemeldet als</p>'
                .'<h3 class="text-center">'.$user->name.'</h3>'
                .'<p class="text-center"><a href="'.$pages->get('name=logout')->url.'?p='.$page->id.'" class="button button-primary">Abmelden</a></p>';
} else {
    
    $form = $modules->get("InputfieldForm");
    $form->action = "./";
    $form->method = "post";
    $form->attr("id+name",'login-form');

    $field = $modules->get("InputfieldText");
    $field->label = "Benutzername";
    $field->attr('id+name', 'username');
    $field->required = 1;
    $form->append($field);

    $field = $modules->get("InputfieldText");
    $field->label = "Passwort";
    $field->attr('id+name', 'password');
    $field->required = 1;
    $field->attr('type', 'password');
    $form->append($field);

    $field = $modules->get("InputfieldHidden");
    $field->attr('id+name', 'redirect');
    $form->append($field);
    $field->value = $sanitizer->intUnsigned($input->r);

    $submit = $modules->get("InputfieldSubmit");
    $submit->attr("value", "Anmelden");
    $submit->attr("id+name", "submit");
    $submit->addClass("button button-primary");
    $form->append($submit);

    $content.= '<div class="text-center">'.$form->render().'</div>';
}

if($input->post->submit) {
  $form->processInput($input->post);
  $username = $form->get("username");
  $password = $form->get("password");
  $redirect = $form->get("redirect");
  if($username->value && $password->value) {
    try {
      $new_user = $session->login($username->value, $password->value);
      if($new_user) {
        $session->message(sprintf(__("Sie sind angemeldet als, %s!"), $new_user->name));
        if($redirect->value) {
          $page_id = $sanitizer->intUnsigned($redirect->value);
          $session->redirect($pages->get($page_id)->url());
        } else {
          $session->redirect($homepage->url);
        }
      } else {
        $password->error(__("Die Kombination aus Benutzername und Passwort ist falsch."));
      }
    } catch(Exception $ex) {
      $password->error($ex->getMessage());
    }
  }
}

$content = renderMainPanel($title, $content);

// Sidebar Content
// $sidebar = renderDefaultSideBar($page);Ï

?>