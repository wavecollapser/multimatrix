<?php
/* MULTI MATRIX PRINT LIBRARY - (C) 2014 MICHAEL OLE OLSEN <GNU@GMX.NET>
 * THIS SOFTWARE IS FREE SOFTWARE; SEE LICENSE IN THIS DIRECTORY
 * LICENSED AS GPL3 OR NEWER
 * IF YOU USE IT, YOU MUST REDISTRIBUTE THE SOURCE
 *
 * FUNCTIONS:
 * save/show any number of text fields into your database with php
 *
 * DYNAMICAL FIELD MATRIX GENERATOR
 */

/* Save POST result in array $rowdata
 * Must be called before printing */
function MultiMatrix_save()
{
    // allow html fields, so don't escape them.
    // you must escape your end array before using in MySQL
    $fields=$_POST['fields'];

    $xmax=strip_tags($_POST['maxfieldsx']);
    $ymax=strip_tags($_POST['maxfieldsy']);

    $cnt=0; $x=0; $y=0; $cont=0;
    $rowdata=array();

    for ($x=0;$x<$xmax;$x++)
    {
        for ($y=0;$y<$ymax;$y++)
        {
            $rowdata[$x][$cnt]=$fields[$cont++];

            if ($cnt < $ymax)
                $cnt++;
            else  /* end of row */
                $cnt=0;
        }
    }

    if ($xmax == 0 && $ymax==0)
    {
        /* print a textarea */
        $rowdata[0][0]=$fields[$cont++];
        MultiMatrix_print($rowdata,$numrows=1);
    }
    else
        MultiMatrix_print($rowdata,$numrows=$xmax);
}

/* Print all rows for a POST result */
function MultiMatrix_print(&$rowdata,$numrows=0)
{
    $i=0;
    for ($i=0;$i<($numrows);$i++)
    {
        $str = join(",",$rowdata[$i]);

        // do your mysql stuff here, remember you must escape $str yourself!
        echo "row: " . $str ."<br>";
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
