<?php
namespace app\index\controller;
class Url{
    //没有爬过的url
    private $url_arr_no = [ ];
    //已经爬过的url
    private $url_arr_over = [ ];
    //获取url的正则表达式
    private $url_reg ="/<a href=['\"](.*?)['\"].*?>(.*?)<\/a>/i";
    //获取ftp地址的正则表达式
    private $ftp_reg = "/<td[\d\D]*?><a href=\"([\d\D]*?)\">[\d\D]*?<\/a><\/td>/i";
    //url前缀
    private $prefix_url = null;
    //查找到的数据
    public $ftp_result = [ ];
    public function __construct( $url = "" ){
        if( empty( $url ) ){
            echo "url不能为空";
            return false;
        }
        $this ->url_arr_no[ ] = $url;
        $this ->prefix_url = $url;
    }
    //开始执行
    public function start( ){
        echo "查找开始<br/>";
        $ch = curl_init( );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , 1 );
        curl_setopt ( $ch , CURLOPT_CONNECTTIMEOUT ,10 );
        while( ! empty( $this ->url_arr_no ) ){
            //foreach ( $this->url_arr_no as $key => $value ) {
            $value = array_shift($this->url_arr_no);
//            if( substr( $value, 0,8 )  == "/webPlay"){
//                continue;
//            }
            if( ! in_array( $value , $this->url_arr_over ) ){ //如果需要查找的url没有爬过,就开始爬
                curl_setopt ($ch, CURLOPT_URL, $value );
                $content = curl_exec($ch);

                //利用正则进行解析页面内容
                preg_match_all( $this->url_reg, $content , $url_match );
                preg_match_all( $this->ftp_reg, $content , $ftp_match );
                curl_close($ch);
//                p($url_match[1]);die;
//                p($url_match[1]);die;
                //如果新查到的url已经在待查询或者已经查询的数组中存在,就不添加
                if( ! empty( $url_match[1] ) ){
                    foreach( $url_match[1] as $url ){
                        if( ! in_array( $url, $this->url_arr_no ) && ! in_array( $url,$this->url_arr_over )){
                            $this ->url_arr_no[ ] =$this ->prefix_url.$url;
                        }
                    }
                }

                //如果ftp地址已经存在,就不进行存储
                if( ! empty( $ftp_match[1] ) ){
                    foreach( $ftp_match[1] as $ftp ){
                        if( ! in_array( $ftp, $this->ftp_result ) ){
                            $this ->ftp_result[ ] = $ftp;
                            file_put_contents("result.txt", $ftp."\r\n" , FILE_APPEND);
                        }
                    }
                }
                $this ->url_arr_over[ ] = $value;
                $key_arr = array_keys( $this->url_arr_no,$value );
                if( ! empty( $key_arr ) ){
                    foreach( $key_arr as $k => $v ){
                        unset( $this->url_arr_no[ $v ] );
                    }
                }
                $temp=array_unique($this->url_arr_no);
                $str='';
                foreach($temp as $k=>$v){
                    echo $v."<br>";
                }
                die;
            }
            //}
        }
        p($this->url_arr_no);die;

    }
}