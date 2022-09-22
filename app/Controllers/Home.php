<?php

class Home extends Controller
{
   public function __construct()
   {
      $this->session_cek();
   }

   public function index()
   {
      $pageInfo = ['title' => 'Home'];
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view('home/home_main');
   }
}
