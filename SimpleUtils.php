<?php

class SimpleUtils {
    public static function getJsonFromQueryResult($qr) {
        $arr = array();
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return json_encode($arr);
    }
    public static function getTableRowsAsJson($conn, $tableName) {
        $res = $conn->query('SELECT * FROM '.$tableName.' ; ');
        if(!$res || $conn->error) {
            throw new Exception('Query failed : '.$conn->error);
        }
        return self::mysqliResToJson($res);
    }
    public static function mysqliResToJson($res) {
        $rows = [];
        while($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public static function p($msg) {
        echo "\n$msg\n";
    }
    public static function loadJson($fn) {
        return json_decode(file_get_contents($fn),true);
    }
    public static function writeJson($fn, $arr) {
        return file_put_contents($fn, json_encode($arr));
    }

    public static function execCommand($cmd) {
        $out = [];
        exec($cmd, $out, $res);
        $out = array_filter($out);
        return $out;
    }
}


