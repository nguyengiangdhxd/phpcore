<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/2016
 * Time: 10:57 AM
 */

class TodoItem {
    const DATA_PATH = 'API/Data';
    public $todo_id;
    public $title;
    public $description;
    public $due_date;
    public $is_done;

    public function save($user_name, $password){
        $userhash = sha1("{$user_name}_{$password}");
        if( is_dir(self::DATA_PATH."/{$userhash}") === false ) { // kiểm tra xem đã có đường dẫn đó chưa
       // nếu chưa có đường dẫn thì tạo một têp tương tụ
            mkdir(self::DATA_PATH."/{$userhash}");
        }
        if(is_null($this->todo_id || !is_numeric($this->todo_id))){
            $this->todo_id = time();
        }
        $todo_item_array = $this->toArray();

        $success = file_put_contents(self::DATA_PATH."/{$userhash}/{$this->todo_id}.txt", serialize($todo_item_array));

        //if saving was not successful, throw an exception
        if( $success === false ) {
            throw new Exception('Failed to save todo item');
        }

        return $todo_item_array;
    }

    public function toArray()
    {
        //return an array version of the todo item
        return array(
            'todo_id' => $this->todo_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'is_done' => $this->is_done
        );
    }
}