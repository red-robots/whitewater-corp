<?php
/* Created By: Lisa DeBona
 * Created On: 09.28.2020
/* ==================================================================================
 * No more configuration
 * ================================================================================== */

function remove_plaintext_email($emailAddress) {
$emailRegEx = '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4})/i';
return preg_replace_callback($emailRegEx, "encodeEmail", $emailAddress);
}

function encodeEmail($result) {
return antispambot($result[1]);
}
add_filter( 'the_content', 'remove_plaintext_email', 20 );
add_filter( 'widget_text', 'remove_plaintext_email', 20 );


function extract_emails_from($string) {
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}

add_filter ('the_content', 'anti_email_spam', 15);
function anti_email_spam ($string) {
  $content = '';
  $emails_matched = ($string) ? extract_emails_from($string) : '';
  if($emails_matched) {
    foreach($emails_matched as $em) {
      $encrypted = antispambot($em,1);
      $replace = 'mailto:'.$em;
      $new_mailto = 'mailto:'.$encrypted;
      $string = str_replace($replace, $new_mailto, $string);
      $rep2 = $em.'</a>';
      $new2 = antispambot($em).'</a>';
      $string = str_replace($rep2, $new2, $string);
    }
    $content = wpautop($string);
  } else {
    $content = wpautop($string);
  }
  return $content;
}

function email_obfuscator($string) {
  $output = '';
  if($string) {
      $emails_matched = ($string) ? extract_emails_from($string) : '';
      if($emails_matched) {
          foreach($emails_matched as $em) {
              $encrypted = antispambot($em,1);
              $replace = 'mailto:'.$em;
              $new_mailto = 'mailto:'.$encrypted;
              $string = str_replace($replace, $new_mailto, $string);
              $rep2 = $em.'</a>';
              $new2 = antispambot($em).'</a>';
              $string = str_replace($rep2, $new2, $string);
          }
      }
      $string = apply_filters('the_content',$string);
  }
  return $string;
}

function emailize($text) {
  $regex = '/(\S+@\S+\.\S+)/';
  $replace = '<a href="mailto:$1">$1</a>';
  return preg_replace($regex, $replace, $text);
}

?>