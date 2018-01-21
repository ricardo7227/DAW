<?php

namespace twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TwitterAsuka
 *
 * @author Gato
 */
class TwitterAsuka {

    private $consumer_key;
    private $consumer_secret;
    private $oauth_token;
    private $oauth_token_secret;
    private $twitterAsuka;

    public function __construct($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret) {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->oauth_token = $oauth_token;
        $this->oauth_token_secret = $oauth_token_secret;
        $this->createService();
    }

    private function createService() {
        $this->twitterAsuka = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->oauth_token, $this->oauth_token_secret);
    }

    public function postMessage($message) {

        $status = $this->twitterAsuka->post(
                "statuses/update", [
            "status" => $message
                ]
        );

        return $status;
    }

}
