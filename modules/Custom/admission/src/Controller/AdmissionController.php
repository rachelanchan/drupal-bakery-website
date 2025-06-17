<?php
namespace Drupal\admission\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class ReviewsController extends ControllerBase{
    public function createAdmission(){
        $form = \Drupal::buildForm()->getForm('Drupal\admission\Form\AdmissionForm');

        return[
            '#theme' => 'admission',
            '#items' => $form,
            '#title' => 'Admission Form'
        ];

    }

    public function showdata(){
        $query = \Drupal::database();
        $result = $query->select('admission','a')
                ->fields('a',['id','fname','sname','gender','email','mobile','address'])
                ->execute()->fetchall(\PDO::FETCH_OBJ);
        
        $data = [];

        foreach($result as $row){
            $data[] = [
                'id' => $row->id,
                'fname' => $row->fname,
                'sname' => $row->sname,
                'gender' => $row->gender,
                'email' => $row->email,
                'mobile' => $row->mobile,
                'address' => $row->address,
                
            ];
        }
        $header = array(' Id ' , ' FirstName ' , ' SurName ' , ' Gender ', 'Email', 'Mobile ', 'Address');

        $build['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' => $data
        ];
        return[
            $build,
            '#title' => 'Admission List' ];
        }

}