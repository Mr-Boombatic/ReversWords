<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

function reverseLetters($sentence) {
	$reversed = "";
    $upperCasePos = [];
	$tmp = "";

    for($i = 0; $i < strlen($sentence); $i++) {
        if (preg_match('/[' . preg_quote('.,;:?!-', '/') . ']+$/', $sentence[$i])) {
            $reversed .= $tmp . $sentence[$i];
            $tmp = "";
            continue;
        }

        if (ctype_upper($sentence[$i])) {
            $upperCasePos[] = $i;
            $tmp = $sentence[$i] . strtolower($tmp); 
            continue;
        }

        $tmp = $sentence[$i] . $tmp;    
    }

    // find out the position of uppear letters and reverse the case of letters
    
    $reversed .= $tmp;
    return $reversed;
}

class ReverseWordTest extends TestCase
{
    public function testReverseLetters() {

        echo reverseLetters("Cat");
        $this->assertEquals(reverseLetters("Cat"), "Tac");
        $this->assertEquals(reverseLetters("Мышь"), "Ьшым");
        $this->assertEquals(reverseLetters("houSe"), "esuOh");
        $this->assertEquals(reverseLetters("домИК"), "кимОД");
        $this->assertEquals(reverseLetters("elEpHant"), "tnAhPele");
        $this->assertEquals(reverseLetters("cat,"), "tac,");
        $this->assertEquals(reverseLetters("Зима:"), "Амиз:");
        $this->assertEquals(reverseLetters("is 'cold' now"), "si 'dloc' won");
        $this->assertEquals(reverseLetters("это «Так» 'просто'"), "отэ «Кат» 'отсорп'");
        $this->assertEquals(reverseLetters("third-part"), "driht-trap");
        $this->assertEquals(reverseLetters("can`t"), "nac`t");
    }
}