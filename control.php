
<?php

$dataHTML=<<<BOF
<div class="iTopicQUE_R">
<p>แนะนำ 2 เว็บด้านล่าง ทำ tag cloud จากฐานข้อมูล จะเป็นเว็บที่ 2<br />
<a href="http://www.thaicreate.com/community/tag-cloud.html" >
http://www.thaicreate.com/community/tag-cloud.html</a><br />
<a href = "http://www.narongrit.net/download-readdownload-id63.html" >
http://www.narongrit.net/download-readdownload-id63.html</a></p>
<a href= "www.google.com">Google</a><br />
<a href='code.google.com' >Code Goodle</a><br />
<a Href="#">anchor</a><br />
<a href="mailto:ninenik@gmail.com">mail to</a><br />
<a href="?data=3">Some Argument</a><br />
<a href=index.html?data=3>Some Argument 2</a><br />
<a href="www.ninenik.com">Ninenik.com</a><br />
</div>
BOF;
echo "<strong>ตัวอย่าง ส่วนของเนื้อหาที่ยังไม่ได้จัดรูปแบบ ของ ลิ้งค์</strong><br/>";
echo $dataHTML;
echo "<hr>";
echo "<strong>ตัวอย่าง ส่วนของเนื้อหาที่ จัดรูปแบบ ของ ลิ้งค์ แล้ว</strong><br/>";
function adjustLink($matches){
    $linkMody="http://www.ninenik.com/weblink/?"; // รูปแบบลิ้งค์ที่นำไปปรับเพิ่ม
    $siteDomain="www.ninenik.com"; // domain เว็บที่ไม่ต้องกำหนดรูปแบบ ลิ้งค์ใหม่
    $matchesData=strtolower($matches[0]);
    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($matchesData."</a>"); 
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($dom);    
    $LinkTag = $xpath->query('//a[@href]');  
    foreach ($LinkTag as $val) {        
        $matchesData=trim($val->getAttribute('href'));
    }   
    if(preg_match("/^(mailto:)|^(#)|^(\?)/",$matchesData)){
        return "<a href=\"$matchesData\">";
    }
    if(!preg_match("@^(https?://)@",$matchesData)){
        if(preg_match("/$siteDomain/i",$matchesData)){
            return "<a href=\"http://".$matchesData."\">";
        }else{
            return "<a href=\"".$linkMody."http://".$matchesData."\">";
        }       
    }else{
        if(preg_match("/$siteDomain/i",$matchesData)){
            return "<a href=\"$matchesData\">";
        }else{
            return "<a href=\"".$linkMody.$matchesData."\">";
        }
         
    }
}

?>




// การใช้งาน
// $dataHTML คือ ข้อมูล html สามารถส่งค่าตัวแปรมาได้
// adjustLink คือชื่อฟังก์ชัน ที่ใช้สำหรับจัดรูปแบบของ url ลิ้งค์ link
//$pathen="/<a[^<]+?>/";
//echo preg_replace_callback($pathen,"adjustLink",$dataHTML);
//?>


