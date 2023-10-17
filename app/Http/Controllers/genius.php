<?php
require_once('../vendor/autoload.php');
require_once '../colorextract/colors.inc.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

$authentication = new \Genius\Authentication\OAuth2(
'dJSpMvbLlTx8SoEybHgb6QvkL1zfn9EwfMlMRkSg0WBqSVxKEAI32JcHQQQAXsl_',
'x2S30kKV9BOyJKLDW8vw6MEL-knVqLCozIVctOanJRKtgncgtTRgzeuwUae-_fHuonTnR-H8k64yR8VPcAgI3g',
'http://localhost:8000',

new \Genius\Authentication\ScopeList([
    \Genius\Enum\Scope::ME(),
    \Genius\Enum\Scope::CREATE_ANNOTATION(),
    \Genius\Enum\Scope::MANAGE_ANNOTATION(),
    \Genius\Enum\Scope::VOTE(),
    ]),
    null
    );

$accessTokenFromDatabase = '2B2ud0qzOKZK2aIIHPn-rPKHQjAuXIBAY36EyUww79TA7slrI15_6sDmhixInBqT';
if ($accessTokenFromDatabase === null) {
    $authorizeUrl = $authentication->getAuthorizeUrl();
    // redirect user to $authorizeUrl
} else {
    $authentication->setAccessToken($accessTokenFromDatabase);
}

$genius = new \Genius\Genius($authentication);