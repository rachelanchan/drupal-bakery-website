<?php
namespace Drupal\reviews\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class ReviewsController extends ControllerBase{
    public function createReviews(){
        $form = \Drupal::buildForm()->getForm('Drupal\reviews\Form\ReviewForm');

        return[
            '#theme' => 'reviews',
            '#items' => $form,
            '#title' => 'Reviews Form'
        ];

    }

    public function showdata(){
        $query = \Drupal::database();
        $result = $query->select('reviews','r')
                ->fields('r',['id','fname','sname','review'])
                ->execute()->fetchall(\PDO::FETCH_OBJ);
        
        $data = [];

        foreach($result as $row){
            $data[] = [
                'id' => $row->id,
                'fname' => $row->fname,
                'sname' => $row->sname,
                'review' => $row->review,
                
            ];
        }
        $header = array(' Id ' , ' FirstName ' , ' SurName ' , ' Reviews ' );

        $build['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' => $data
        ];
        return[
            $build,
            '#title' => 'Review List' ];
        }

}