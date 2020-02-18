<?php

class AysMySQL {
    public $dbSource = "";

    public function __construct(){
        // $this->dbSource = new Swoole\Mysql();
        $this->dbSource = new swoole_mysql();
        $this->dbConfig = [
            'host' => '127.0.0.1',
            'port' => '3306',
            'user' => 'root',
            'password' => 'YIZPHitPeJs8V26roOdM0w7yJdZn8RUA',
            'database' => 'flower',
            
        ];
        

    }

    public function update() 
    {

    }

    public function execute($id, $name)
    {
        // connect
        $this->dbSource->connect($this->dbConfig, function($db, $result){
            if(!$result){
                var_dump($db->connect_error);
            }

            $sql = "select * from tags where id=1";
            $db->query($sql, function($db, $result){

                if($result === false) {

                } elseif($result === true) { // add update delete

                } else { // select
                    print_r($result);
                }
            });
        });
        return true;
    }

}

$obj = new AysMySQL();
$obj->execute(1,'test');


// $db = new swoole_mysql();
// $server = array(
//     'host' => '127.0.0.1',
//     'port' => 3306,
//     'user' => 'root',
//     'password' => 'YIZPHitPeJs8V26roOdM0w7yJdZn8RUA',
//     'database' => 'flower',
//     'charset' => 'utf8', //指定字符集
//     'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
// );

// $db->connect($server, function ($db, $r) {
//     if ($r === false) {
//         var_dump($db->connect_errno, $db->connect_error);
//         die;
//     }
//     $sql = 'show tables';
//     $db->query($sql, function(swoole_mysql $db, $r) {
//         if ($r === false)
//         {
//             var_dump($db->error, $db->errno);
//         }
//         elseif ($r === true )
//         {
//             var_dump($db->affected_rows, $db->insert_id);
//         }
//         var_dump($r);
//         $db->close();
//     });
// });