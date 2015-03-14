<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CoatingsController extends AppController {

    public $helpers = ['Html', 'Form'];

    public function index() {
        $this->set('coatings', $this->Coating->find('all'));
    }

    public function select($arg1, $arg2, $arg3) {
        if ($arg1 == 5) {
            $conditions = ['Coating.compatible' => 5];
            $this->set('coatings', $this->Coating->find('all', ['conditions' => $conditions]));
        } else {
            if ($arg1 == 3 || $arg1 == 4) {
                $conditions = ['Coating.compatible' => 0];
                $this->set('coatings', $this->Coating->find('all', ['conditions' => $conditions]));
            } else {
                $conditions = ['Coating.compatible' => null];
                $this->set('coatings', $this->Coating->find('all', ['conditions' => $conditions]));
            }
        }
    }

}
