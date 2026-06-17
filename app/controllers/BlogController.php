<?php

require_once 'app/core/Controller.php';

class BlogController extends Controller {

    public function index() {
        $blogModel = $this->model('Blog');

        $page = max(1, intval($_GET['page'] ?? 1));
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $blogs = $blogModel->getAll($limit, $offset);
        $totalBlogs = $blogModel->countAll();
        $totalPages = ceil($totalBlogs / $limit);

        $this->view('blog/index', [
            'title' => 'Blog & Artikel - Second Store',
            'blogs' => $blogs,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function detail($id) {
        $blogModel = $this->model('Blog');
        $blog = $blogModel->getById($id);

        if (!$blog) {
            $this->redirect('/blog');
        }

        $related = $blogModel->getRelated($id, 5);

        $this->view('blog/detail', [
            'title' => $blog['title'] . ' - Blog Second Store',
            'blog' => $blog,
            'related' => $related
        ]);
    }
}
