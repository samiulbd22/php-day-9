<?php
require_once 'vendor/autoload.php';
use App\classes\Home;
use App\classes\Blog;

if (isset($_GET['pages']))
{
    if ($_GET['pages'] == 'home')
    {
        include 'pages/home.php';
    }else if ($_GET['pages'] == 'all-blog')
    {
        $blog = new Blog();
        $allBlogs = $blog->getAllBlogs();
        include 'pages/allBlogs.php';
    }
}
elseif (isset($_POST['btn']))
{
    $blog = new Blog($_POST);
    $message = $blog->index();
    include 'pages/home.php';
}