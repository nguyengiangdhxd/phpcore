<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 12/23/15
 * Time: 3:09 PM
 */

namespace Core;

use Flywheel\Cache\Storage;
use Flywheel\Config\ConfigHandler;
use Mongodb\ConnectMongoDB;

class Translator {
    public static function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false)
    {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        if ($lower_str_end) {
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        } else {
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $str = $first_letter . $str_end;
        return $str;
    }

    public static $list_position = array(-1 => 'O1', 1 => 'S1', 2 => 'S2', 3 => 'Adj1', 4 => 'Adj2', 5 => 'Adj3');

    /**
     * Dịch thuộc tính sản phẩm
     * @param string $title Thuộc tính/tên thuộc tính
     * @param array $resource Nguồn từ khóa dùng để dịch
     * @return mixed|null|string
     */
    public static function translateProperty($title = null, $resource = null)
    {
        //$no_translator = ConfigHandler::get('no_translator');
        //if ($no_translator){
        //    return $title;
        //}

        try{
            if (empty($resource)) {
                $resource = self::resourceKeyToTranslate();
            }

            foreach ($resource as $r) {
                $title = strpos($title, $r['keyword_china']) !== false
                    ? str_replace($r['keyword_china'], $r['keyword_vi']. ' ', $title)
                    : $title;
            }

            return self::mb_ucfirst($title);
        }catch (\Exception $e){
            return $title;
        }
    }

    /**
     * Dịch tiêu đề/tên sản phẩm
     * @param string $title
     * @param array $resource
     * @return mixed|string
     */
    public static function translateTitle($title, $resource = null)
    {
        $no_translator = ConfigHandler::get('no_translator');
        if ($no_translator){
            return $title;
        }

        $resource = self::resourceKeyToTranslate('title_translate');
        $keywords = $resource;

        $found_words = array();
        $found_values = array();
        $exist_groups = array();

        foreach (self::$list_position as $key => $name) {
            $found_words[$key] = array();
        }

        if (!empty($keywords)) {
            foreach ($keywords as $keyword) {
                if (stripos($title, $keyword['keyword_china']) !== false) {
                    $title = str_replace($keyword['keyword_china'], ' ', $title);
                    $tags = $keyword['tags'];
                    if (trim($tags) != '') {
                        $tags = explode(',', $tags);
                    }
                    $lay = true;
                    $processed_tags = array();
                    if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            if (in_array(trim(mb_strtolower($tag, 'UTF-8')), $exist_groups)) {
                                $processed_tags[] = mb_strtolower($tag, 'UTF-8');
                                $lay = false;
                            }
                            $exist_groups[] = mb_strtolower($tag, 'UTF-8');
                        }
                    }

                    if (!in_array(trim(mb_strtolower($keyword['keyword_vi'], 'UTF-8')), $found_values) && $lay) {
                        $found_words[$keyword['vi_position']][] = $keyword['keyword_vi'];
                        $found_values[] = trim(mb_strtolower($keyword['keyword_vi'], 'UTF-8'));

                        if (!empty($processed_tags))
                            $exist_groups = array_merge($processed_tags, $exist_groups);
                    }
                }
            }
        }

        $str_new = '';
        if (!empty($found_words)) {
            foreach ($found_words as $key => $values) {
                // lap qua danh sach cac tu lay dc
                if (!empty($values)) {
                    if ($key == 1 || $key == 2 || $key == -1) { //khong dung dau , giua S1 va S2
                        if ($key == 2) {
                            $sub_str = $values[0];
                        } else {
                            $sub_str = implode('/', $values);
                        }
                    } else {
                        $sub_str = implode(', ', $values);
                    }

                    if ($str_new == '') {
                        $str_new .= $sub_str;
                    } elseif ($key == 1 || $key == 2 || $key == -1) {
                        $str_new .= ' ' . $sub_str;
                    } else
                        $str_new .= ', ' . $sub_str;
                }
            }
        }

        $result = self::mb_ucfirst($str_new);
        if (preg_replace('/\s/', '', $result) == '') {
            $result = $title;
        }
        return $result;
    }

    /**
     * Lấy về bộ từ điển
     * @param string $tbName
     * @return mixed
     */
    public static function resourceKeyToTranslate($tbName = 'keyword')
    {
        static $resources;
        if (null == $resources) {
            $resources = array();
        }

        if (isset($resources[$tbName])) {
            return $resources[$tbName];
        }

        try {
            $cache = Storage::factory('translating');
            $resources[$tbName] = $cache->get($tbName);
        } catch(\Exception $e) {
            Logger::factory('system')->error("Exception: " .$e->getMessage() .' at ' .$e->getFile() .':' .$e->getLine());
        }

        $mandango = ConnectMongoDB::getConnection();

        if ($tbName == 'keyword') {
            $repo = new \Mongodb\TranslatorKeywordRepository($mandango);
        }
        else {
            $repo = new \Mongodb\TranslatorTitleKeywordRepository($mandango);
        }

        $all_keywords = $repo->createQuery()->sort(['weighted' => -1])->all();

        if (!$all_keywords) {
            return [];
        }
        foreach ($all_keywords as $keyword) {
            $resources[$tbName][] = $keyword->toArray();
        }

        if ($cache instanceof \Flywheel\Cache\IStorage) {
            try {
                $cache->set($tbName, $resources[$tbName], 86400); //1 days
            } catch(\Exception $e) {
                Logger::factory('system')->error("Exception: " .$e->getMessage() .' at ' .$e->getFile() .':' .$e->getLine());
            }
        }

        return $resources[$tbName];
    }
} 