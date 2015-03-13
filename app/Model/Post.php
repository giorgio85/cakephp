<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Post extends AppModel {
    public $name = 'Post';

    public $validate = ['title' => array(
    'rule' => 'notEmpty'
    ),
    'body' => array(
    'rule' => 'notEmpty'
    ),
    'Imagen' => array(
    'notEmpty' => array(
    'rule' => array('notEmpty'),
    'message' => 'Elige una imagen'
    ),
    ),
    ];
}
