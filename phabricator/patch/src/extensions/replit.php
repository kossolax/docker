<?php

final class PhabricatorREPLITRemarkupRule extends PhabricatorRemarkupCustomInlineRule {

  public function getPriority() {
    return 500.0;
  }

  public function apply($text) {
    return preg_replace_callback( '@{replit=(.+?)\s+([a-zA-Z]+?)#(.+?)}@m', array($this, 'markupNavigation'), $text);
  }

  public function markupNavigation(array $matches) {


    $img = celerity_get_resource_uri("/rsrc/image/RUN-".$matches[1]."-blue.svg");
    $result = "<a target=\"_blank\" href=\"https://repl.it/@ISIPS/".$matches[2]."#".$matches[3]."\"><img style=\"display:inline-block;\" src=\"".$img."\" /></a>";
    $engine = $this->getEngine();

    if ($engine->isHTMLMailMode()) {
      return phutil_safe_html($result);
    }

    return $this->getEngine()->storeText(phutil_safe_html($result));
  }

  public function didMarkupText() {
    CelerityAPI::getStaticResourceResponse()
      ->addContentSecurityPolicyURI('frame-src', 'https://img.shields.io/');
  }

}
