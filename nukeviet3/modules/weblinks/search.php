<?php

/**
 * @Project  NUKEVIET V3
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES., JSC. All rights reserved
 * @Createdate  03-05-2010
 */

if ( ! defined( 'NV_IS_MOD_SEARCH' ) ) die( 'Stop!!!' );

$sql = "SELECT SQL_CALC_FOUND_ROWS `id`,`title`,`description` 
FROM `" . NV_PREFIXLANG . "_" . $m_values['module_data'] . "_rows` 
WHERE " . nv_like_logic( 'title', $dbkeyword, $logic ) . " 
OR " . nv_like_logic( 'description', $dbkeyword, $logic ) . " 
LIMIT " . $pages . "," . $limit;

$tmp_re = $db->sql_query( $sql );

$result = $db->sql_query( "SELECT FOUND_ROWS()" );
list( $all_page ) = $db->sql_fetchrow( $result );

if ( $all_page )
{
    $link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=visitlink&amp;id=';

    while ( list( $id, $tilterow, $content ) = $db->sql_fetchrow( $tmp_re ) )
    {
        $url = $link . $alias . "-" . $id;

        $result_array[] = array( //
            'link' => $link . $id, //
            'title' => BoldKeywordInStr( $tilterow, $key, $logic ), //
            'content' => BoldKeywordInStr( $content, $key, $logic ) //
            );
    }
}

?>