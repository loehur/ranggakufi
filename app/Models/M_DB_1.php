<?php

class M_DB_1
{
    private $db;

    public function __construct()
    {
        $this->db = DB_1::getInstance();
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

    //GET
    public function get($table)
    {
        return $this->db->get($table);
    }

    public function get_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function get_cols_where($table, $cols, $where, $row)
    {
        return $this->db->get_cols_where($table, $cols, $where, $row);
    }

    public function get_cols_groubBy($table, $cols, $groupBy)
    {
        return $this->db->get_cols_groubBy($table, $cols, $groupBy);
    }

    public function get_where_order($table, $where, $order)
    {
        return $this->db->get_where_order($table, $where, $order);
    }

    public function get_order($table, $order)
    {
        return $this->db->get_order($table, $order);
    }

    public function get_where_row($table, $where)
    {
        return $this->db->get_where_row($table, $where);
    }

    //====================================================== COUNT//
    public function count_where($table, $where)
    {
        return $this->db->count_where($table, $where);
    }

    //===========================================================

    public function insert($table, $values)
    {
        return $this->db->insert($table, $values);
    }
    public function insertCols($table, $columns, $values)
    {
        return $this->db->insertCols($table, $columns, $values);
    }

    public function delete_where($table, $where)
    {
        return $this->db->delete_where($table, $where);
    }
    public function update($table, $set, $where)
    {
        return $this->db->update($table, $set, $where);
    }
    public function innerJoin1($table, $tb_join, $join_where)
    {
        return $this->db->innerJoin1($table, $tb_join, $join_where);
    }
    public function innerJoin1_where($table, $tb_join, $join_where, $where)
    {
        return $this->db->innerJoin1_where($table, $tb_join, $join_where, $where);
    }
    public function innerJoin1_orderBy($table, $tb_join, $join_where, $orderBy)
    {
        return $this->db->innerJoin1_orderBy($table, $tb_join, $join_where, $orderBy);
    }
    public function innerJoin2($table, $tb_join1, $join_where1, $tb_join2, $join_where2)
    {
        return $this->db->innerJoin2($table, $tb_join1, $join_where1, $tb_join2, $join_where2);
    }
    public function innerJoin2_where($table, $tb_join1, $join_where1, $tb_join2, $join_where2, $where)
    {
        return $this->db->innerJoin2_where($table, $tb_join1, $join_where1, $tb_join2, $join_where2, $where);
    }
}
