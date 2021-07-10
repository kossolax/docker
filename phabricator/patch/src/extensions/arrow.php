<?php

final class PhabricatorArrowRemarkupRule extends PhabricatorRemarkupCustomInlineRule {

  public function getPriority() {
    return 500.0;
  }

  public function apply($text) {
    return preg_replace_callback(
      '@{arrow="(.*?)"\s(.*?)}@m',
      array($this, 'markupNavigation'),
      $text);
  }

  public function markupNavigation(array $matches) {
    

    $result = "<span class=\"sz-arrow\" data-arrow-to=\"".$matches[1]."\">".$matches[2]."</span>";
    $engine = $this->getEngine();

    if ($engine->isHTMLMailMode()) {
      return phutil_safe_html($result);
    }

    return $this->getEngine()->storeText(phutil_safe_html($result));
  }
}
