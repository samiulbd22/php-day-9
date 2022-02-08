<?php


namespace App\classes;


class Blog
{
    protected $title;
    protected $authorName;
    protected $description;
    protected $image;
    protected $imageName;
    protected $directory;
    protected $fileName;
    protected $file;
    protected $data;
    protected $array;
    protected $array1;
    protected $array2;

    public function __construct($post = null)
    {
//        echo "<pre/>"; //$post = null
//        print_r($post);  //$post = null
//        print_r($_FILES);
        //value assign ->
        $this->title =$post['title'];
        $this->authorName =$post['author_name'];
        $this->description =$post['description'];
    }

    public function index()
    {
//        $this->imageName = $_FILES['blog_image']['name'];
//        $this->directory = 'assets/img/upload/'.$this->imageName;
//        move_uploaded_file($_FILES['blog_image']['tmp_name'],$this->directory);
        $this->image = $this->imageUpload();
//        echo $this->image;
//        exit();
        $this->fileName = 'db.txt';
        $this->file = fopen('db.txt','a');
        $this->data ="$this->title,$this->authorName,$this->description,$this->image$";
        fwrite($this->file, $this->data); //file open->
        fclose($this->file); //file close <-
        return'Data saved successfully';

    }
    public function imageUpload()
    {
        $this->imageName = $_FILES['blog_image']['name'];
        $this->directory = 'assets/img/upload/'.$this->imageName;
        move_uploaded_file($_FILES['blog_image']['tmp_name'],$this->directory);
        return $this->directory;

    }
    public function getAllBlogs()
    {
        $this->fileName = 'db.txt';
        $this->data = file_get_contents($this->fileName);
        $this->array = explode('$',$this->data);
//        echo '<pre/>';
//        echo $this->array;
        foreach ($this->array as $key =>$value)
        {
            //echo $value;
            $this->array2 = explode(',',$value);
//            echo '<pre/>';
//            print_r($this->array2);
            if ($this->array2[0])
            {
                $this->array1[$key]['title'] =$this->array2[0];
                $this->array1[$key]['author_name'] =$this->array2[1];
                $this->array1[$key]['description'] =$this->array2[2];
                $this->array1[$key]['blog_image'] =$this->array2[3];
            }

        }
        return$this->array1;


    }

}