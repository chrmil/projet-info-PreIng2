<?php //to convert a string date from old_format to new format
        function format($date){ //$date = string following format "d-m-Y"
            $format = "d/m/Y";
            $old_format = "d-m-Y";
            $datetime =  new DateTime();
            $datetime = date_create_from_format($old_format, $date);
            $date = date_format($datetime, $format) ;
            return $date; //$date = string following format "d/m/Y"
         }
?>
