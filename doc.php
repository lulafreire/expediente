<?php
function populate_RTF($vars, $doc_file) {
     
    $replacements = array ('\\' => "\\\\",
                           '{'  => "\{",
                           '}'  => "\}");
    
    $document = file_get_contents($doc_file);
    if(!$document) {
        return false;
    }
    
    foreach($vars as $key=>$value) {
        $search = "%%".strtoupper($key)."%%";

        foreach($replacements as $orig => $replace) {
            $value = str_replace($orig, $replace, $value);
        }
        
        $document = str_replace($search, $value, $document);
    }
    
    return $document;
 }
?>