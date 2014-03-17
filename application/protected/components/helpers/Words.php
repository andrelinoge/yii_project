<?
class Words
{
    /**
     * @param $n integer
     * @param $form1 string
     * @param $form2 string
     * @param $form5 string
     * @return string
     */
    public static function plural($n, $form1, $form2, $form5)
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;

        if ($n > 10 && $n < 20)
        {
            return $form5;
        }
        else if ($n1 > 1 && $n1 < 5)
        {
            return $form2;
        }
        else if ($n1 == 1)
        {
            return $form1;
        }
        else
        {
            return $form5;
        }

    }
}