use PHPUnit\Framework\TestCase;

class ReverseLettersInWordsTest extends TestCase {
    public function testReverseLetters() {
        $this->assertEquals(reverseLettersInWords("Cat"), "Tac");
        $this->assertEquals(reverseLettersInWords("Мышь"), "Ьшым");
        $this->assertEquals(reverseLettersInWords("houSe"), "esuOh");
        $this->assertEquals(reverseLettersInWords("домИК"), "кимОД");
        $this->assertEquals(reverseLettersInWords("elEpHant"), "tnAhPele");
        $this->assertEquals(reverseLettersInWords("cat,"), "tac,");
        $this->assertEquals(reverseLettersInWords("Зима:"), "Амиз:");
        $this->assertEquals(reverseLettersInWords("is 'cold' now"), "si 'dloc' won");
        $this->assertEquals(reverseLettersInWords("это «Так» \"просто\""), "отэ «Кат» \"отсорп\"");
        $this->assertEquals(reverseLettersInWords("third-part"), "driht-trap");
        $this->assertEquals(reverseLettersInWords("can`t"), "nac`t");
    }
}

function reverseLettersInWords($string) {
    $words = preg_split('/(\w+|[^\w\s])/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    foreach ($words as &$word) {
        if (ctype_alpha($word)) {
            $chars = preg_split('//u', $word, null, PREG_SPLIT_NO_EMPTY);
            $reversed_chars = array_map(function($char) {
                return ctype_upper($char) ? mb_strtoupper($char) : mb_strtolower($char);
            }, array_reverse($chars));
            $word = implode('', $reversed_chars);
        }
    }

    $reversed_string = implode('', $words);
    return $reversed_string;
}
