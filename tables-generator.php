<?php

/**
 * Program to output multiplication tables from - till (eg 2 x 1 = 2 to 20 x 1 = 20) in rows & cols specified,
 * with whitespace chars (\n \t, no HTML) and underscore, bar (_ & |) are used for borders which is optional,
 * input arguments are tables from, tables till, columns, borders, lines per table (2 x 20 = 40).
 * 
 * Tested in php 7.4 and 8.1
 */

class MultiplicationTables {

    //Lets take input arguements & print tables
    public static function print( 
        $tableStart, // multiplication table from
        $tableEnd, // multiplication table till 
        $columns, // no of tables per row 
        $seperator = 'borders', // whether to produce borders or just spaces
        $tableLines = 10 // no of lines per table
        ) {

        // validation
        if ($tableStart >= $tableEnd || in_array(0, [$tableStart, $columns, $tableLines]) || !in_array($seperator, ['borders', 'spaces', '']) ) {
            echo "Error : invalid input\n\n"
                . "1. Table-start should be non-zero & <= table-end \n2. No of columns and no of table-lines should be non zero \n3. Seperator can only be empty, 'borders' or 'spaces' \n\n";
            exit;
        }

        $total_rows = ceil( ( $tableEnd - $tableStart + 1 ) / $columns ); // total no of rows

        // filling formating variables if borders
        if (in_array($seperator, ['borders', '']) ) {
            
            $borderV = str_repeat('_', 15) . '|'; // verticle borders
            $outerTopBorder = str_repeat( str_repeat( '_', 16 ), $columns ) . "\n";
            $borderH = $outerLeftBorder = '|';

        } elseif ($seperator == 'spaces') { 
            $borderH = $borderV = $outerTopBorder = $outerLeftBorder = ''; // no borders looks good as well!
        }

        for( $outerRow = 1; $outerRow <= $total_rows; $outerRow++ ) { // each outer row

            for( $rowLine = 1; $rowLine <= $tableLines + 1; $rowLine++ ) { // each row line

                $tableLineEnd = min( $tableStart + $columns - 1, $tableEnd ); // no of table lines (2 x 1 = 2) per each row line

                //lets start with outer top border
               if ( $outerRow == 1 && $rowLine == 1 ) {
                    echo $outerTopBorder; // works only if border is required!
                }

                for( $tableLine = $tableStart; $tableLine <= $tableLineEnd; $tableLine++ ) { // 1 loop is 1 table line
                    if ($rowLine == $tableLines + 1){
                        $aTableLine = $borderV;
                    } else {
                        $aTableLine = " $tableLine x $rowLine = " . $tableLine * $rowLine . "\t$borderH"; // print table line
                    }
                    echo $tableLine == $tableStart ? $outerLeftBorder . $aTableLine : $aTableLine;
                    // echo "tableLine is $tableLine "; // test
                }
                echo "\n";
                // echo "rowLine is $rowLine "; // test
            }
            $tableStart += $columns;
            // echo "outerRow is $outerRow "; // test
        }
    }
}

echo '<pre>'; // for spaces & line breaks in html

// lets print table 12 to 20 with 6 tables per row & no optional arguments
MultiplicationTables::print( 12, 20, 6 );

// lets print table 2 to 12 with 5 tables per row with spaces and 20 lines per tables
echo "\n\n";
MultiplicationTables::print( 1, 12, 6, 'spaces', 20 );

// lets give some wrong input
echo "\n\n";
MultiplicationTables::print( 5, 3, 0, '3d', 20 );

echo '</pre>';
