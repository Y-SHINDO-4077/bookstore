<?php 
   function parseToXML($htmlStr)
   {
   $xmlStr=str_replace('<','&lt;',$htmlStr);
   $xmlStr=str_replace('>','&gt;',$xmlStr);
   $xmlStr=str_replace('"','&quot;',$xmlStr);
   $xmlStr=str_replace("'",'&#39;',$xmlStr);
   $xmlStr=str_replace("&",'&amp;',$xmlStr);
   return $xmlStr;
   }
   
   
   
   if($results->Count() > 0){
    // Start XML file, echo parent node
    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind=0;
    foreach($results as $row){
      // Add to XML document node
      echo '<marker ';
      echo 'id="' . $row['id'] . '" ';
      echo 'name="' . parseToXML($row['name']) . '" ';
      echo 'region="' . parseToXML($row['region']) . '" ';
      echo 'pref="' . parseToXML($row['pref']) . '" ';
      echo 'address="' . parseToXML($row['address']) . '" ';
      echo 'image_path="' . parseToXML($row['image_path']) . '" ';
      echo 'user_id="' . parseToXML($row['user_id']) . '" ';
      echo 'created_at="' . parseToXML($row['created_at']) . '" ';
      echo 'updated_at="' . parseToXML($row['updated_at']) . '" ';
      echo '/>';
      $ind = $ind + 1;
    }
    // End XML file
      echo '</markers>';
  }
?>