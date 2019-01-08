<?php
/**
 * Created by PhpStorm.
 * User: douglasmarsola
 * Date: 2018-12-13
 * Time: 12:59 PM
 */

class user
{
    private $fn;
    private $ln;
    private $em;
    private $pwd;
//    private $enabled;
//    private $rooms;

    public function __construct($info) {
        if ($info){
            $filename = md5($info["em"]);
            if (!file_exists("./users/${$filename}")){
                foreach ($info as $key=>$value)
                    $this->$key = $info[$key];
                $this->save();
            }
        }
    }

    public function load($id){
        $filename = "./users/" . $id . "/user";
        if (!file_exists($filename)){
            $userinfo = json_decode(file_get_contents($filename));
            foreach ($userinfo as $key=>$value)
                $this->$key = $userinfo->$key;
            $this->save();
            return true;
        } else
            return false;
    }

    public function change($key, $value){
        if ($key !== 'em') { // only the email cannot be changed for now.
            $this->$key = $value;
            $this->save();
        }
    }

    public function get($key){
        return $this->$key;
    }

//    public function addRoom($id){
//        $this->rooms = json_encode(array_push(json_decode($this->rooms), $id));
//        $this->save();
//    }
//
//    public function removeRoom($id){
//        $this->rooms = json_encode(array_diff(json_decode($this->rooms), $id));
//        $this->save();
//    }

    private function save(){
        $temp = array();
        array_push($temp, $this->fn);
        array_push($temp, $this->ln);
        array_push($temp, $this->em);
        array_push($temp, $this->pwd);
//        array_push($temp, $this->enabled);
//        array_push($temp, json_decode($this->rooms));
        $filename = "./users/" . md5($this->em);
        file_put_contents($filename, json_encode($temp));
    }

}