<?php

namespace Drupal\Subscribe\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements form.
 */
class SubscribeForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(){
    return 'subscribe_subscribe_form';
  }

  /***
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $type = \Drupal::request()->get('type');

    $form['type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Content Type'),
      '#default_value' => $type,
      '#disabled' => TRUE,
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your Email Address'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $type = $form_state->getValue('type');
    $mail = $form_state->getValue('email');

    //get database connection
    $database = \Drupal::database();

    //check if the email already exists
    $result = $database->query("SELECT id FROM {subscribe_subscriptions} WHERE mail = :mail", [':mail' => $mail])->fetchField();

    if($result){
      $this->messenger()->addStatus($this->t('You have an existing subscription. Thank you.'));
    }
    else{
      $sub = $database->insert('subscribe_subscriptions')
      ->fields([
        'mail' => $mail,
        'content_type' => $type,
        'timestamp' => REQUEST_TIME,
      ])
      ->execute();

      $this->messenger()->addStatus($this->t('Your subscription has been saved.You\'ll now recieve updates'));

    }






  }
}
