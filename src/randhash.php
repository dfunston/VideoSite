<?php

$randLoaded=true;

//This script is LoLzT3HrAnDoM!!! Waffles!

function lolzRandom($numDigits){
	if(!$numDigits){$numDigits = 5;} //Default number of digits, produces over 5 billion results.
	for($i=0;$i<=$numDigits;$i++){
		$digit[$i] = rand(0,61);
		switch($digit[$i]){
			case 10:
				$digit[$i]='a';
				break;
			case 11:
				$digit[$i]='b';
				break;
			case 12:
				$digit[$i]='c';
				break;
			case 13:
				$digit[$i]='d';
				break;
			case 14:
				$digit[$i]='e';
				break;
			case 15:
				$digit[$i]='f';
				break;
			case 16:
				$digit[$i]='g';
				break;
			case 17:
				$digit[$i]='h';
				break;
			case 18:
				$digit[$i]='i';
				break;
			case 19:
				$digit[$i]='j';
				break;
			case 20:
				$digit[$i]='k';
				break;
			case 21:
				$digit[$i]='l';
				break;
			case 22:
				$digit[$i]='m';
				break;
			case 23:
				$digit[$i]='n';
				break;
			case 24:
				$digit[$i]='o';
				break;
			case 25:
				$digit[$i]='p';
				break;
			case 26:
				$digit[$i]='q';
				break;
			case 27:
				$digit[$i]='r';
				break;
			case 28:
				$digit[$i]='s';
				break;
			case 29:
				$digit[$i]='t';
				break;
			case 30:
				$digit[$i]='u';
				break;
			case 31:
				$digit[$i]='v';
				break;
			case 32:
				$digit[$i]='w';
				break;
			case 33:
				$digit[$i]='x';
				break;
			case 34:
				$digit[$i]='y';
				break;
			case 35:
				$digit[$i]='z';
				break;
			case 36:
				$digit[$i]='A';
				break;
			case 37:
				$digit[$i]='B';
				break;
			case 38:
				$digit[$i]='C';
				break;
			case 39:
				$digit[$i]='D';
				break;
			case 40:
				$digit[$i]='E';
				break;
			case 41:
				$digit[$i]='F';
				break;
			case 42:
				$digit[$i]='G';
				break;
			case 43:
				$digit[$i]='H';
				break;
			case 44:
				$digit[$i]='I';
				break;
			case 45:
				$digit[$i]='J';
				break;
			case 46:
				$digit[$i]='K';
				break;
			case 47:
				$digit[$i]='L';
				break;
			case 48:
				$digit[$i]='M';
				break;
			case 49:
				$digit[$i]='N';
				break;
			case 50:
				$digit[$i]='O';
				break;
			case 51:
				$digit[$i]='P';
				break;
			case 52:
				$digit[$i]='Q';
				break;
			case 53:
				$digit[$i]='R';
				break;
			case 54:
				$digit[$i]='S';
				break;
			case 55:
				$digit[$i]='T';
				break;
			case 56:
				$digit[$i]='U';
				break;
			case 57:
				$digit[$i]='V';
				break;
			case 58:
				$digit[$i]='W';
				break;
			case 59:
				$digit[$i]='X';
				break;
			case 60:
				$digit[$i]='Y';
				break;
			case 61:
				$digit[$i]='Z';
				break;
		}
		$result = $result . $digit[$i];
	}
	return $result;
	
	
}


?>