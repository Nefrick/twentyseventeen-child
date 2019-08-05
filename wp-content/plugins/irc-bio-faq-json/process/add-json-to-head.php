<?php
add_action('wp_head', 'add_faq_json');

function add_faq_json() {

    $page_id = get_option('faq_page');

    if(is_page( $page_id )){

        $faqData = get_post_meta( $page_id, 'faq_data_json', true );

?>
        <!-- start schema rich snippets markup -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": [
  <?php $i = 0; $coma = ','; ?>
  <?php foreach ( $faqData as $question ):
                $i++;
                if(count($faqData) == $i ) $coma = '';
         echo   '{'.PHP_EOL;
         echo   '"@type": "Question",'.PHP_EOL;
         echo   '"name": "'.$question['question'].'",'.PHP_EOL;
         echo   '"acceptedAnswer": {'.PHP_EOL;
         echo   '"@type": "Answer",'.PHP_EOL;
         echo   '"text": "'. trim(wp_kses_post($question['answer'])).'"'.PHP_EOL;
         echo   ' } '.PHP_EOL;
         echo   ' }'.$coma.' '.PHP_EOL;
  endforeach;
  ?>
                ]
            }
        </script>
        <!-- end schema rich snippets markup -->
<?php
    }




}