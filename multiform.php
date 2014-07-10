<?php
/* MULTI MATRIX PRINT LIBRARY - (C) 2014 MICHAEL OLE OLSEN <GNU@GMX.NET>
 * SAVE/SHOW ANY NUMBER OF TEXT FIELDS INTO YOUR DATABASE WITH PHP
 * /


/* Save POST result in array $rowdata
 * Must be called before printing */
function MultiMatrix_save()
{
    $fields=$_POST['fields'];
    //print_r($fields);
    $maxx=$_POST['maxfieldsx'];
    $maxy=$_POST['maxfieldsy'];
    //echo "maxx: $maxx , maxy: $maxy<br>";

    $cnt=0;
    $x=0;
    $z=0;
    $rowdata=array();
    $cont=0;
    $y=0;

    for ($x=0;$x<$maxx;$x++)
    {
        for ($y=0;$y<$maxy;$y++)
        {
            $rowdata[$x][$cnt]=$fields[$cont++];

            if ($cnt < $maxy)
                $cnt++;
            else  /* end of row */
                $cnt=0;
        }

    }

    if ($maxx == 0 && $maxy==0)
    {
        /* print a textarea */
        $rowdata[0][0]=$fields[$cont++];
        MultiMatrix_print($rowdata,$numrows=1);
    }
    else
        MultiMatrix_print($rowdata,$numrows=$maxx);
}

/* Print all rows for a POST result */
function MultiMatrix_print(&$rowdata,$numrows=0)
{
//print_r($rowdata);
    $i=0;
    for ($i=0;$i<($numrows);$i++)
    {
        $str = join(",",$rowdata[$i]);
        echo "row: " . $str ."<br>";
        //echo "row: " . implode(",",$rowdata[$i]) . "<br>";
    }

}
function MultiMatrix_textarea($field_data=NULL,$rows=25,$cols=15)
{
    echo "<form method=post action=>";
    echo "<table>";
    echo "<input type=hidden name=maxfieldsx value=0>";
    echo "<input type=hidden name=maxfieldsy value=0>";
    echo "<textarea name=fields[] " .
          "rows=" . $rows. " cols=" . $cols . ">" .
          $field_data[0] . "</textarea>";
    echo "<br>";
    echo "<input type=reset value=Reset><input type=submit value=Save></form>";
}
function MultiMatrix($maxfieldsx=8, $maxfieldsy=3, 
    $colwidth=NULL, $coltitles=NULL, $field_data=NULL)
{
    // size of each row's elements, pass an arr to this function with it
    if (!$colwidth)
    {
        $colwidth[0]=15;
        $colwidth[1]=15;
        $colwidth[2]=15;
    }

    echo "<form method=post action=>";
    echo "<table>";
    if ($coltitles!=NULL) {
        echo "<tr>";
        foreach ($coltitles as $k => $w)
            echo "<td>" . $k . "</td>";
        echo "</tr>";
    }
    echo "<input type=hidden name=maxfieldsx value=" . $maxfieldsx . ">";
    echo "<input type=hidden name=maxfieldsy value=" .$maxfieldsy .">";
    $cnt=0;
    for ($x=0;$x<$maxfieldsx;$x++)
    {
        echo "<tr>";
        for ($y=0;$y<$maxfieldsy;$y++)
        {
            $width=$colwidth[$y];
            echo "<td>";
            echo "<input type=text name=fields[] value=\"" .
                 $field_data[$cnt] . "\" size=" . $width . ">";
            echo "</td>";
            $cnt++;
        }
        echo "</tr>";
    }
    echo "</table><input type=submit></form>";
}

?>
