<?php
/**
 * 
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-01 10:30:57
 * @version $Id$
 */

namespace app\modules\wechat\models;
use yii;
use yii\base\Model;

class Wechat extends CommonModel
{

    /**
     * 账号详情
     * @param  int $id 帐号id
     * @return array
     */
    public function getAccount($id)
    {
        return $this->db->createCommand('select id, name, wx_id, appid, appsecret, remarks from {{%wx_account}} where id = :id', ['id' => $id])->queryOne();
    }

    /**
     * 验证微信签名
     * @param  array $data  微信发送的数据
     * @param  string $token 系统生成的签名
     * @return boolen
     */
    public function checkSignature($data, $token)
    {
        $tmpArr = [$data['timestamp'], $data['nonce'], $token];
        sort($tmpArr, SORT_STRING);
        $singature = sha1(implode($tmpArr));
        if($singature === $data['signature']){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 数组转xml
     * @param  array  $arr  待转换的数组
     * @param  int $level 是否需要xml
     * @return xml
     */
    public function arrayToXml($arr, $level = 1) 
    {
        $s = $level == 1 ? "<xml>" : '';
        foreach ($arr as $tagname => $value) {
            if (is_numeric($tagname)) {
                $tagname = $value['TagName'];
                unset($value['TagName']);
            }
            if (!is_array($value)) {
                $s .= "<{$tagname}>" . (!is_numeric($value) ? '<![CDATA[' : '') . $value . (!is_numeric($value) ? ']]>' : '') . "</{$tagname}>";
            } else {
                $s .= "<{$tagname}>" . array2xml($value, $level + 1) . "</{$tagname}>";
            }
        }
        $s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
        return $level == 1 ? $s . "</xml>" : $s;
    }

    public function xmlToArray($xmlData)
    {
        $data = new \SimpleXMLElement ($xmlData);
        $return = [];
        foreach ($data as $k => $v) {
           $return[$k] = strval($v);
        }
        return $return;
    }
}