<?php
namespace Drupal\dn_students\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class StudentController extends ControllerBase{
    public function createStudent(){
        $form = \Drupal::buildForm()->getForm('Drupal\dn_students\Form\StudentForm');

        return[
            '#theme' => 'dn_students',
            '#items' => $form,
            '#title' => 'Student Form'
        ];

    }

    public function showdata(){
        $query = \Drupal::database();
        $result = $query->select('students','s')
                ->fields('s',['id','fname','sname','age','marks'])
                ->execute()->fetchall(\PDO::FETCH_OBJ);
        
        $data = [];

        foreach($result as $row){
            $data[] = [
                'id' => $row->id,
                'fname' => $row->fname,
                'sname' => $row->sname,
                'age' => $row->age,
                'marks' => $row->marks
            ];
        }
        $header = array(' Id ' , ' FirstName ' , ' SurName ' , ' Age ' , ' Marks ' );

        $build['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' => $data
        ];
        return[
            $build,
            '#title' => 'Student List' ];
        }

}