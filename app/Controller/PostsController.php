<?php

class PostsController extends AppController
{
    //public $helpers = array('Html', 'Form');
    //public $components = array('Cookie','RequestHandler');
    public $components = array('Cookie', 'RequestHandler');
    public $output;

    public function beforeFilter()
    {
        parent::beforeFilter();
       // $this->Auth->allow('index', 'register');
    }

    public function index()
    {
        //$value = $this->request->data['tag'];
        //$this->set('posts', $this->Post->find('all'));
        //foreach ($posts as $post):{
        //$post['Post']['id'];
//			$post['Post']['title'];
        //		$value = $post['Post']['created'];
        //}
//		endforeach;

//		if($this->Cookie->check('User.username')) {
//			$output = array(
//				"status" => "OK",
//				"message" => " are good",
//				"content" => true);
//		}
        //else
        {
            //	$this->Cookie->path = null;
            //debug($this->Cookie->check('User.username'));
            // if ($this->request->is('post')) {
            $this->loadModel("User");
            $usr = $this->request->data['username'];
            //debug($usr);
            $pwd = $this->request->data['password'];
            $result = $this->User->find('first', array('conditions' => array('User.username' => $usr, 'User.password' => $pwd)));
            if ($result) {
                //login success
                $this->Cookie->write('User.login', 1);
                $this->Cookie->write('User.name', $result['User']['username']);
                $output = array(
                    "status" => "OK",
                    "message" => " are good",
                    "content" => true);


            } else {
                $output = array(
                    "status" => "Failed",
                    "message" => "Not authenticated",
                    "content" => $usr);
                //login unsuccessfull
                // $this->set('message','Invalid username or password');
                //          }
            }
//            if($this->Auth->login()) {
//                $this->Cookie->write('User.username', 'pavan', false, '1 hour');
//                //debug($this->Cookie->read('User.username'));
//                $output = array(
//                    "status" => "OK",
//                    "message" => " are good",
//                    "content" => false);
//            }
//            else
//            {
//                $output = array(
//                    "status" => "Failed",
//                    "message" => "Not authenticated",
//                    "content" => false);
//            }
//		}

            //$this->set('posts', $this->Post->find('all'));
            //$value = $this->request->data('tag');
            $this->set($output);
            $this->set("_serialize", array("status", "message", "content"));
        }
    }

    public function register()
    {
        $this->loadModel("User");
        if($this->request->is('post')) {
            if ($this->request->is('post')) {

                //$this->User->create();
                $this->request->data['username'] = $this->request->data['mobilenumber'];
                if ($this->User->save($this->request->data)) {
                   // $this->Cookie->write('User.name', $result['User']['mobilenumber']);
                    $output = array(
                        "status" => "OK",
                        "message" => " are good",
                        "content" => true);
                } else {
                    $output = array(
                        "status" => $this->request->data['username'],
                        "message" => "Not authenticated",
                        "content" => "hi");

                }
            }
            $this->set($output);
            $this->set("_serialize", array("status", "message", "content"));
        }
    }
}
?>