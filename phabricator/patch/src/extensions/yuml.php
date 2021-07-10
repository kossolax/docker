<?php

final class PhabricatorYUMLRemarkupRule extends PhabricatorRemarkupCustomInlineRule {
  const KEY_RULE_EXTERNAL_IMAGE = 'rule.yuml.cache';

  public function getPriority() {
    return 1.0;
  }

  public function apply($text) {
    return preg_replace_callback( '@{yuml=([a-z]+)\s+((?:.|\s)+?)}@m', array($this, 'markupNavigation'), $text);
  }

  public function markupNavigation(array $matches) {
    $uri = "https://yuml.me/diagram/zaretti/".$matches[1]."/".urlencode(str_replace("\n", ",", $matches[2])).".jpg";
    $src_uri = id(new PhutilURI('/file/imageproxy/'))->replaceQueryParam('uri', $uri);
    $img = id(new PHUIRemarkupImageView())->setURI($src_uri); //->render();

    $engine = $this->getEngine();

    $metadata_key = self::KEY_RULE_EXTERNAL_IMAGE;
    $metadata = $engine->getTextMetadata($metadata_key, array());

    $token = $engine->storeText("<img>");

    $metadata[] = array('token' => $token, 'args' => $uri);
    $engine->setTextMetadata($metadata_key, $metadata);


    if ($engine->isHTMLMailMode()) {
      return phutil_safe_html($img);
    }
    return $this->getEngine()->storeText($img);
  }

  public function didMarkupText() {
    $engine = $this->getEngine();
    $metadata_key = self::KEY_RULE_EXTERNAL_IMAGE;
    $images = $engine->getTextMetadata($metadata_key, array());
    if (!$images) {
      return;
    }

    foreach ($images as $image) {
      $uri = $image['args'];
      $src_uri = id(new PhutilURI('/file/imageproxy/'))->replaceQueryParam('uri', $uri);

      $img = id(new PHUIRemarkupImageView())->setURI($src_uri);
      $engine->overwriteStoredText($image['token'], $img);
    }
  }

}
