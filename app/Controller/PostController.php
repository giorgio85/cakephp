<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Posts';

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

    public function upload() {
        if ($this->request->is('post')) {
            //Check if image has been uploaded
           if ($this->data['Post']['Imagen']) {
				
				$file = new File($this->request->data['Post']['Imagen']['tmp_name'], true, 0644);
				$path_parts = pathinfo($this->data['Post']['Imagen']['name']);
				$ext = $path_parts['extension'];
				if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'gif' && $ext != 'png') {
					$this->Session->setFlash('Solo puedes subir imagenes.');
					$this->render();
				} else {
					$date = $this->data['Post']['Imagen']['name'];
					$filename =$date;
					
					$data = $file->read();
					$file->close();
					
					$file = new File(WWW_ROOT.'img/'.$filename,true);
					$file->write($data);
					$file->close();
				}
			}
			//Fin subir imagenes
			
			$this->request->data['Post']['Imagen'] = $this->request->data['Post']['Imagen']['name'];
			$this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }

}
