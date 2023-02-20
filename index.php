<?php


function walkInArray($start,$finish,$field){

    $field[$start[0]][$start[1]] = 2;
    $field[$finish[0]][$finish[1]] = 3;
    $pos = $start;

    $validWay = validWay($field,$pos);
    
    while($validWay){
        
        if(isSolved($field,$pos) === true)
        {
            showField($field);
            return true;
        }

        $cord = $validWay[count($validWay) - 1];
        $pos[1] = $cord % 10;
        $pos[0] = ($cord - $pos[1]) / 10;
        $field[$pos[0]][$pos[1]] = 5;
        array_pop($validWay);
        $validWay = array_merge($validWay,validWay($field,$pos));
        
    }
    showField($field);
    return false;
}

function validWay($field,$pos){
    $validWay = [];
    
    if($field[$pos[0] - 1][$pos[1]] === 0) array_push($validWay, $pos[0] - 1 . $pos[1]);
    if($field[$pos[0]][$pos[1] + 1] === 0) array_push($validWay, $pos[0] . $pos[1] + 1);
    if($field[$pos[0] + 1][$pos[1]] === 0) array_push($validWay, $pos[0] + 1 . $pos[1]);
    if($field[$pos[0]][$pos[1] - 1] === 0) array_push($validWay, $pos[0] . $pos[1] - 1);    
    return $validWay;
}
function isSolved($field,$pos){
    if($field[$pos[0] - 1][$pos[1]] === 3) return true;
    if($field[$pos[0]][$pos[1] + 1] === 3) return true;
    if($field[$pos[0] + 1][$pos[1]] === 3) return true;
    if($field[$pos[0]][$pos[1] - 1] === 3) return true;
    return false;
}



/// field
$field = [
    [1, 1, 1, 0, 0, 0],
    [0, 1, 1, 0, 1, 0],
    [0, 0, 1, 0, 1, 0],
    [1, 0, 1, 0, 1, 0],
    [1, 0, 0, 1, 0, 0],
    [1, 0, 0, 0, 0, 1],
];
var_dump(walkInArray([1,0],[0,9],$field));



//// showArray
function showField($field){
    foreach($field as $line):
        echo '<br>';
        foreach($line as $element):
            echo $element;
        endforeach;
    endforeach;
}
