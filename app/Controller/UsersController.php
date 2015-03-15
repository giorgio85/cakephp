<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::import('Controller', 'Posts');
App::import('Controller', 'Orders');

class UsersController extends AppController {

    public $helpers = ['Html', 'Form'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup', 'logout', 'login');
    }

    public function index() {
        //comprobar perfil
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc')
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario creado'));
                return $this->redirect(array('action' => 'index')); //<- probablemente mal
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario actualizado'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido editar el usuario'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario incorrecto'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario eliminado'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuario no eliminado'));
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'profile'));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenido, ' . $this->Auth->user('username')));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Usuario y/o contraseña incorrectos'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function signup() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario creado'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Session->setFlash(__('No se ha podido crear el usuario'));
        }
    }

    public function profile() {
        if (!$this->Auth->user()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $filename = "";
        $this->set('userid', $this->Auth->user('id'));
        if ($this->request->is('post')) {
            //Check if image has been uploaded
            if ($this->data['User']['avatar']) {
                /* $file = new File($this->request->data['Post']['imageurl']['tmp_name'], true, 0644);
                  $path_parts = pathinfo($this->data['Post']['imageurl']['name']);
                  $ext = $path_parts['extension'];
                  if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'gif' && $ext != 'png') {
                  $this->Session->setFlash('Sólo puedes subir imágenes.');
                  $this->render();
                  } else {
                  $date = date("YmdHis");
                  ;
                  $filename = $date . "u" . $this->Auth->user('id') . "." . $ext;

                  $data = $file->read();
                  $file->close();

                  $file = new File(WWW_ROOT . 'img/uploads/' . $filename, true);
                  $file->write($data);
                  $file->close();
                  } */
                require_once ('ImageManipulator.php');
                //require_once ('_image.php');
                $date = date("YmdHis");
                $filename = $date . "u" . $this->Auth->user('id');
                $path_parts = pathinfo($this->data['User']['avatar']['name']);
                $ext = $path_parts['extension'];
                $manipulator = new ImageManipulator($this->request->data['User']['avatar']['tmp_name']);
                $newImage = $manipulator->resample(500, 500);
                $manipulator->save('img/profile/' . $filename . "full." . $ext);
                $width = $manipulator->getWidth();
                $height = $manipulator->getHeight();
                $centreX = round($width / 2);
                $centreY = round($height / 2);
                $x1 = $centreX - 250;
                $y1 = $centreY - 250;

                $x2 = $centreX + 250;
                $y2 = $centreY + 250;

                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                $manipulator->save('img/profile/' . $filename . "." . $ext);
                /* $myImage = new _image;
                  $myImage->uploadTo = 'img/uploads/';
                  $myImage->newName = $filename;
                  $myImage->returnType = 'array';
                  $myImage->duplicates = 'o';
                  $filename = $filename.".".$ext;
                  $img = $myImage->upload($this->request->data['Post']['imageurl'], true, 0644);
                  if ($img){
                  $myImage->source_file = $img['path'].$img['image'];
                  $myImage->newHeight = 500;
                  $myImage->newWidth = 500;
                  $myImage->resize();
                  //$myImage->crop(500,500,0,0);
                  } */
            }
            //Fin subir imagenes
            $this->User->id = $this->Auth->user('id');
            $this->request->data['User']['avatar'] = $filename.".". $ext;
            if ($this->User->set($this->request->data['User']['avatar'])) {
                $this->User->save();
                $this->Session->setFlash('Se ha subido la imagen');
                $this->redirect(['controller' => 'users', 'action' => 'profile']);
           }
        }
    }

    public function orders() {
        $Orders = new OrdersController();
        $conditions = ['Order.userid' => $this->Auth->user('id')];
        $this->set('orders', $Orders->Order->find('all', ['conditions' => $conditions]));
    }

    public function posts() {
        $Posts = new PostsController();
        $conditions = ['Post.userid' => $this->Auth->user('id')];
        $this->set('posts', $Posts->Post->find('all', ['conditions' => $conditions]));
    }

}
