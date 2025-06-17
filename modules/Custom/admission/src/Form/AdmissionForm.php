<?php

namespace Drupal\admission\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;

/**
 * Provides the form for adding countries.
 */
class AdmissionForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admission_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {


    
    $form['fname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
    ];
	 $form['sname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Second Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
    ];
	$form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Gender'),
      '#required' => TRUE,
      '#options' => array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'),
      '#maxlength' => 10,
      '#default_value' => 'Male',
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' => '',
    ];

    $form['mobile'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' => '',
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];

    $form['doa'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date of Admission'),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];

    $form['mother_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Mother's Name"),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];

    $form['mother_mobile'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Mother's Mobile Number"),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];

    $form['father_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Father's Name"),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];

    $form['father_mobile'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Father's Mobile Number"),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#default_value' => '',
    ];
	
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#default_value' => $this->t('Save') ,
    ];
	
	//$form['#validate'][] = 'studentFormValidate';

    return $form;

  }
  
   /**
   * {@inheritdoc}
   */
  public function validateForm(array & $form, FormStateInterface $form_state) {
       $field = $form_state->getValues();
	   
		$fields["fname"] = $field['fname'];
		if (!$form_state->getValue('fname') || empty($form_state->getValue('fname'))) {
            $form_state->setErrorByName('fname', $this->t('Provide First Name'));
        }
		
		
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array & $form, FormStateInterface $form_state) {
	try{
		$conn = Database::getConnection();
		
		$field = $form_state->getValues();
	   
		$fields["fname"] = $field['fname'];
		$fields["sname"] = $field['sname'];
		$fields["gender"] = $field['gender'];
    $fields["email"] = $field['email'];
    $fields["mobile"] = $field['mobile'];
    $fields["doa"] = $field['doa'];
    $fields["address"] = $field['address'];
    $fields["mother_name"] = $field['mother_name'];
    $fields["mother_mobile"] = $field['mother_mobile'];
    $fields["father_name"] = $field['father_name'];
    $fields["father_mobile"] = $field['father_mobile'];


		
		  $conn->insert('admission')
			   ->fields($fields)->execute();
		  \Drupal::messenger()->addMessage($this->t('Your admission response has been saved succesfully!'));
		 
	} catch(Exception $ex){
		\Drupal::logger('admission')->error($ex->getMessage());
	}
    
  }

}
  
