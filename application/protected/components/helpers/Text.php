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
}