<?php

require 'app/Config/URL.php';

class Controller extends URL
{
    public $data_user;

    public $admin, $privilege, $id_user, $userDVC, $userOM, $userTL, $nama_user;
    public $dPrivilege, $dHour, $dDvs, $dEmp, $dUser, $dStaff, $dTL, $dOM, $dQC, $dCS, $dEmpMerge;

    public function __construct()
    {
        if (isset($_SESSION['data_user'])) {
            $this->data_user = $_SESSION['data_user'];
            $this->parameter();
        }
    }

    public function data()
    {
        if (isset($_SESSION['login_user'])) {
            if ($_SESSION['login_user'] == true) {
                if ($_SESSION['userTipe'] == 'admin' || $_SESSION['userTipe'] == 'management') {
                    $this->admin = $_SESSION['user']['admin'];
                    $this->privilege = $_SESSION['user']['privilege'];
                    $this->userDVC = "ADMIN";
                } elseif ($_SESSION['userTipe'] == 'cs' || $_SESSION['userTipe'] == 'qc') {
                    $this->admin = 0;
                    $this->privilege = 0;
                } elseif ($_SESSION['userTipe'] == 'staff' || $_SESSION['userTipe'] == 'tl' || $_SESSION['userTipe'] == 'om') {
                    $this->admin = 0;
                    $this->privilege = 0;
                    $this->userDVC = $_SESSION['user']['dvc'];
                    $this->userOM = $_SESSION['user']['om'];
                    $this->userTL = $_SESSION['user']['tl'];
                }

                $this->id_user = $_SESSION['user']['id'];
                $this->nama_user = $_SESSION['user']['nama'];

                $this->dPrivilege = $_SESSION['data']['privilege'];
                $this->dHour = $_SESSION['data']['hour'];
                $this->dDvs = $_SESSION['data']['divisi'];
                $this->dEmp = $_SESSION['data']['emp'];
                $this->dUser = $_SESSION['data']['user'];

                $this->dStaff = $_SESSION['data']['staff'];
                $this->dTL = $_SESSION['data']['tl'];
                $this->dOM = $_SESSION['data']['om'];
                $this->dQC = $_SESSION['data']['qc'];
                $this->dCS = $_SESSION['data']['cs'];

                $this->dEmpMerge = array_merge($this->dStaff, $this->dTL, $this->dOM);
            }
        }
    }

    public function parameter()
    {
        if ($_SESSION['userTipe'] == 'admin' || $_SESSION['userTipe'] == 'management') {
            $_SESSION['user'] = array(
                'nama' => $this->data_user['nama_user'],
                'id' => $this->data_user['id_user'],
                'admin' => $this->data_user['admin'],
                'privilege' => $this->data_user['privilege'],
            );
        } elseif ($_SESSION['userTipe'] == 'cs' || ($_SESSION['userTipe'] == 'qc')) {
            $_SESSION['user'] = array(
                'nama' => $this->data_user['employee_name'],
                'id' => $this->data_user['employee_id'],
                'admin' => 0,
                'privilege' => 0,
            );
        } elseif ($_SESSION['userTipe'] == 'staff') {
            $_SESSION['user'] = array(
                'nama' => $this->data_user['employee_name'],
                'id' => $this->data_user['employee_id'],
                'admin' => 0,
                'privilege' => 0,
                'dvc' => $this->data_user['ticket_category'],
                'om' => $this->data_user['om'],
                'tl' => $this->data_user['tl'],
            );
        } elseif ($_SESSION['userTipe'] == 'tl') {
            $_SESSION['user'] = array(
                'nama' => $this->data_user['employee_name'],
                'id' => $this->data_user['employee_id'],
                'admin' => 0,
                'privilege' => 0,
                'dvc' => $this->data_user['ticket_category'],
                'tl' => "",
                'om' => $this->data_user['om'],
            );
        } elseif ($_SESSION['userTipe'] == 'om') {
            $_SESSION['user'] = array(
                'nama' => $this->data_user['employee_name'],
                'id' => $this->data_user['employee_id'],
                'admin' => 0,
                'privilege' => 0,
                'dvc' => $this->data_user['ticket_category'],
                'tl' => "",
                'om' => "",
            );
        }

        $_SESSION['data'] = array(
            'privilege' => $this->model('M_DB_1')->get('privilege'),
            'divisi' => $this->model('M_DB_1')->get('ticket_category'),
            'user' => $this->model('M_DB_1')->get_order('user', 'nama_user ASC'),
            'emp' => $this->model('M_DB_1')->get_order('master_tlom', 'employee_name ASC'),
            'staff' => $this->model('M_DB_1')->get_order('master_staff', 'employee_name ASC'),
            'tl' => $this->model('M_DB_1')->get_order('master_tl', 'employee_name ASC'),
            'om' => $this->model('M_DB_1')->get_order('master_om', 'employee_name ASC'),
            'qc' => $this->model('M_DB_1')->get_order('master_qc', 'employee_name ASC'),
            'cs' => $this->model('M_DB_1')->get_order('master_cs', 'employee_name ASC'),
            'hour' => $this->model('M_DB_1')->get_order('hour_list', 'hour_id ASC'),
        );
    }

    public function session_cek()
    {
        if (isset($_SESSION['login_user'])) {
            if ($_SESSION['login_user'] == False) {
                header("location: " . $this->BASE_URL . "Login");
            }
        } else {
            header("location: " . $this->BASE_URL . "Login");
        }
    }

    public function view($file, $data = [])
    {
        $this->data();
        require_once "app/Views/" . $file . ".php";
    }

    public function model($file)
    {
        require_once "app/Models/" . $file . ".php";
        return new $file();
    }
}
