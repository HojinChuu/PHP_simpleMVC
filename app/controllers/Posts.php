<?php

class Posts extends Controller
{
    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            if(empty($data['title'])) {
                $data['title_err'] = "제목을 입력해주세요";
            }

            if(empty($data['body'])) {
                $data['body_err'] = "내용을 입력해주세요";
            }

            if(empty($data['title_err']) && empty($data['body_err'])) {
                
                if($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts/index');
                } else {
                    die('Something went wrong');
                }

            } else {
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
    
            $this->view('posts/add', $data);
        }
    }
}