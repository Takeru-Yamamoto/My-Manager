<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Pagenation
| -------------------------------------------------------------------------
*/

// URIのどのセグメントにページ番号をセットするか指定
$config['uri_segment'] = 3;

 

// 選択中のページ番号の前後に表示したい "数字" リンクの数
$config['num_links'] = 2;

 

// 1ページに表示する件数
$config['per_page'] = 3;

 

// ページネーション全体を囲む開始、終了タグ
$config['full_tag_open'] = '<p>';
$config['full_tag_close'] = '</p>';

 

// ページの先頭へのリンク文字、開始、終了タグ
$config['first_link'] = '最初';
$config['first_tag_open'] = '<div>';
$config['first_tag_close'] = '</div>';

 

// ページの先頭へのリンクURL
$config['first_url'] = '';

 

// ページの最後へのリンク文字、開始、終了タグ
$config['last_link'] = '最後';
$config['last_tag_open'] = '<div>';
$config['last_tag_close'] = '</div>';

 

// 次ページへのリンク文字、開始、終了タグ
$config['next_link'] = '次へ';
$config['next_tag_open'] = '<div>';
$config['next_tag_close'] = '</div>';

 

// 前ページへのリンク文字、開始、終了タグ
$config['prev_link'] = '前へ';
$config['prev_tag_open'] = '<div>';
$config['prev_tag_close'] = '</div>';

 

// 現在ページの開始、終了タグ
$config['cur_tag_open'] = '<b>';
$config['cur_tag_close'] = '</b>';

 

// 現在ページ以外の開始、終了タグ
$config['num_tag_open'] = '<div>';
$config['num_tag_close'] = '</div>';

 

// class属性の追加
$config['attributes'] = array('class' => 'myclass');

 

// URLパスにオフセットではなくページ番号を使用する
$config['use_page_numbers'] = TRUE;

 

// URLパスにセットするオフセットのプレフィックス、サフィックス
$config['prefix'] = '';
$config['suffix'] = '';

 

// ページ移動リンクの表示
// $config['display_pages'] = FALSE;

 

// ページ番号をクエリストリングに変更
// $config['page_query_string'] = TRUE;

 

// ページ番号をクエリストリングにした場合のパラメータ名
// $config['query_string_segment'] = 'per_page';