<?php
namespace app\index\controller;

use think\Controller;

class Test extends Controller
{
    public function index(){
        header( "Content-type:text/html;Charset=utf-8" );
        $url = "www.pinhee.com";
        $class = new Url($url);
        $class -> start();
    }
    public function calculate(){
        return $this->fetch();
    }
    public function test()
    {
        /*
        * 使用curl 采集hao123.com下的所有链接。
        */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'');
        // 只需返回HTTP header
        curl_setopt($ch, CURLOPT_HEADER, 1);
        // 页面内容我们并不需要
        // curl_setopt($ch, CURLOPT_NOBODY, 1);
            // 返回结果，而不是输出它
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($html === false) {
            echo "cURL Error: " . curl_error($ch);
        }
        curl_close($ch);
        $linkarr = $this->_striplinks($html);
        // 主机部分，补全用
        $host = '';
        if (is_array($linkarr)) {
            foreach ($linkarr as $k => $v) {
                $linkresult[$k] = $this->_expandlinks($v, $host);
            }
        }
        printf("<p>此页面的所有链接为：</p><pre>%s</pre>n", var_export($linkresult, true));
    }

    public function _striplinks($document)
    {
        preg_match_all("/'<s*as.*?hrefs*=s*([\"'])?(?(1) (.*?)\1 | ([^s>]+))'isx/", $document, $links);
        while (list($key, $val) = each($links[2])) {
            if (!empty($val))
                $match[] = $val;
        }
        while (list($key, $val) = each($links[3])) {
            if (!empty($val))
                $match[] = $val;
        }
        return $match;
    }

    /*===================================================================*
    Function:	_expandlinks
    Purpose:	expand each link into a fully qualified URL
    Input:	$links	the links to qualify
    $URI	the full URI to get the base from
    Output:	$expandedLinks	the expanded links
    *===================================================================*/
    public function _expandlinks($links, $URI)
    {
        $URI_PARTS = parse_url($URI);
        $host = $URI_PARTS["host"];
        preg_match(" /^[^?]+/", $URI, $match);
        $match = preg_replace(" |/[^/.]+.[^/.]+$|", "", $match[0]);
        $match = preg_replace(" |/$|", "", $match);
        $match_part = parse_url($match);
        $match_root =
            $match_part["scheme"] . "://" . $match_part["host"];
        $search = array("|^http://" . preg_quote($host) . "|i",
            "|^(/)|i",
            "|^(?!http://)(?!mailto:)|i",
            "|/./|",
            "|/[^/]+/../|"
        );
        $replace = array("",
            $match_root . "/",
            $match . "/",
            "/",
            "/"
        );
        $expandedLinks = preg_replace($search, $replace, $links);
        return $expandedLinks;
    }
}