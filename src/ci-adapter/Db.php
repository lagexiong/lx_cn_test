<?php

namespace CiAdapter;

/**
 * 数据库类，适配CI数据库操作
 *
 * @author jw
 * @since 2020-04-03
 */
class Db
{
    // 主库
    const DEFAULT = "default";

    // 备份库
    const BAK = "bak";

    // 统计库
    const STAT = "stat";

    // 分析库
    const ADS = "ads";

    // 测试库
    const TEST = "test";


    /**
     * 数据库连接对象
     *
     * @var object
     */
    private $db;

    /**
     * 单例实例
     *
     * @var array
     */
    private static $instances;

    private function __construct($database)
    {
        //使用CI的数据库连接
        $ci = &get_instance();
        if ($database == "default") {
            $this->db = $ci->db;
        } else {
            $this->db = $ci->load->database($database, true);
        }
    }

    private function __clone(){}

    public static function getInstance($database = "default")
    {
        if(!isset(self::$instances[$database]) || self::$instances[$database] instanceof self){
            self::$instances[$database] = new self($database);
        }
        return self::$instances[$database];
    }

    public function query($sql,$fields = false)
    {
        return $this->db->query($sql,$fields);
    }

    public function select($sql)
    {
        $query = $this->db->query($sql);
        return is_object($query) ? $query->result_array() : [];
    }

    public function get($sql)
    {
        if (!preg_match("/\s+LIMIT\s+1/i", $sql)) {
            $sql .= " LIMIT 1";
        }
        $query = $this->db->query($sql);
        return is_object($query) ? $query->row_array() : [];
    }

    public function insert($sql, $fields = [], $isBatch = false)
    {
        $fields = empty($fields) ? false : $fields;

        $this->query($sql, $fields);

        return $isBatch ? $this->affectedRows() : $this->insertId();
    }


    public function update($sql, $fields = [])
    {
        $fields = empty($fields) ? false : $fields;
        $this->query($sql, $fields);
        return $this->affectedRows();
    }

    public function affectedRows()
    {
        return $this->db->affected_rows();
    }

    public function insertId()
    {
        return $this->db->insert_id();
    }

    public function transBegin()
    {
        $this->db->trans_begin();
    }

    public function transRollback()
    {
        $this->db->trans_rollback();
    }

    public function transCommit()
    {
        $this->db->trans_commit();
    }

    public function lastQuery()
    {
        return $this->db->last_query();
    }

    public function updateBatch($table, $data, $primaryKey)
    {
        return $this->db->update_batch($table, $data, $primaryKey);
    }
}