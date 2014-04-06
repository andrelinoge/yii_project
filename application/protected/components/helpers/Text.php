<?php
class Text
{
    public static function truncate( $text, $limit = NULL, $useThreeDots = FALSE )
    {
        if ( !$limit )
        {
            return $text;
        }
        else
        {
            $text = str_replace( "\t", '', $text );

            $text = trim( strip_tags( $text ) );

            if ( mb_strlen( $text, 'utf-8' ) <= $limit )
            {
                return $text;
            }
            else
            {
                return ( $useThreeDots) ?
                    mb_substr( $text, 0, $limit, 'UTF-8' ) . '...' :
                    mb_substr( $text, 0, $limit, 'UTF-8' );
            }
        }
    }

    public static function to_param($source)
    {
         $replace = array(
            "." => "", "," => "", "!" => "", "?" => "", ":" => "", ";" => "", "#" => "", 
            "+" => "", "-" => '', " " => "-", "'" => "", "`" => "" 
        );

        $string = strtr( $source, $replace );
        $string = trim( $string);

        return strtolower( $string ) ;
    }

    public static function transliterate($source)
    {
        $replace = [
            " " => "-", "'" =>"", "`" =>"", "а" =>"a", "А"=>"a", "б" =>"b", "Б"=>"b", "в" =>"v", "В"=>"v",
            "г" =>"g", "Г"=>"g", "д" =>"d", "Д"=>"d", "е" =>"e", "Е"=>"e", "ж" =>"zh", "Ж"=>"zh", "з" =>"z", "З"=>"z",
            "и" =>"i", "И"=>"i", "й" =>"y", "Й"=>"y", "к" =>"k", "К"=>"k", "л" =>"l", "Л"=>"l", "м" =>"m", "М"=>"m",
            "н" =>"n", "Н"=>"n", "о" =>"o", "О"=>"o", "п" =>"p", "П"=>"p", "р" =>"r", "Р"=>"r", "с" =>"s", "С"=>"s",
            "т" =>"t", "Т"=>"t", "у" =>"u", "У"=>"u", "ф" =>"f", "Ф"=>"f", "х" =>"h", "Х"=>"h", "ц" =>"c", "Ц"=>"c",
            "ч" =>"ch", "Ч"=>"ch", "ш" =>"sh", "Ш"=>"sh", "щ" =>"sch", "Щ"=>"sch", "ъ" =>"", "Ъ"=>"", "ы" =>"y", "Ы"=>"y",
            "ь" =>"", "Ь"=>"", "э" =>"e", "Э"=>"e", "ю" =>"yu", "Ю"=>"yu", "я" =>"ya", "Я"=>"ya", "і" =>"i", "І"=>"i",
            "ї" =>"yi", "Ї"=>"yi", "є" =>"e", "Є"=>"e" 
        ];

        return $str = iconv(
            "UTF-8",
            "CP1251//IGNORE",
            strtr(
                $source,
                $replace
            )
        );
    }


}