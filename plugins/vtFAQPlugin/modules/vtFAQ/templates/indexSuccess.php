<div class="mdl-app">    	
      <div class="container">
        <span class="cor-tl"></span>
        <span class="cor-tr"></span>
        <span class="cor-br"></span>
        <span class="cor-bl"></span>      	
        <div class="mdl-faq">
       	  <h1 class="title"><?php echo __('FAQs');?></h1>
          <?php $i = $key; ?>
           <?php if (count(@$listFaqs) != 0 && !empty($listFaqs)):?>
	         <ul  class="list-faq">
              <?php foreach ($listFaqs as $keys =>$faqs): ?>
              <li>
                <p>
                  <span class="number"><?php echo (++$i).'. ' ?></span>
                  <a href="#" id="question<?php echo ($keys); ?>" class="question">
                    <?php echo nl2br(str_replace( '  ','&nbsp;',VtHelper::strip_html_tags($faqs->getQuestion()))); ?>
                  </a>
                </p>
                <div id="answer<?php echo ($keys); ?>" class="answer content explan" style="display:none">
                  <?php $answer = $faqs->getAnswer(ESC_RAW);
                      if ($answer) 
                      {
                          $purifier = HTMLPurifier::getInstance();
                      echo $purifier->purify($answer);
                      }
                    ?>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div align="center" class="pagging">
                <?php include_partial('vtFAQ/pagging', array('listPager' => $listFaqs)) ?>
            </div>
            <?php else: ?>
            <br/>
            <div class="No-result"><?php echo __('No data'); ?></div>
            <br/>
          <?php endif; ?>
        </div>
      </div>
</div>