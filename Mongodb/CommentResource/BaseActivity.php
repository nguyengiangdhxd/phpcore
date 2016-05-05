<?php

namespace Mongodb\CommentResource;

class BaseActivity extends BaseContext {
    protected $type = BaseContext::TYPE_ACTIVITY;

    public function __construct($data) {
        $this->_attributes['type'] = $this->type;
        #$this->_attributes['clientip'] = \Users::getClientIp();

        $message = '';
        if (is_array($data)) {
            // Người thực hiện
            $user_id = 0;
            if (array_key_exists('user_id', $data)) {
                $user_id = $data['user_id'];
            }
            if ($user_id > 0) {
                $this->_attributes['user_id'] = $user_id;
            }
            // Lấy nội dung
            if (array_key_exists('message', $data)) {
                $message = $data['message'];
            }

            // Tác động tới (chưa rõ => để một mảng thông tin)
            $excludes = array('user_id', $message);
            foreach ($data as $key => $value) {
                if (in_array($key, $excludes)) {
                    continue;
                }
                $this->_attributes[$key] = $value;
            }
        } elseif (is_string($data)) {
            $message = $data;
        }

        // Nội dung
        $this->_attributes['message'] = $message;
    }

    public function getMessage() {
        return $this->_attributes['message'];
    }
}