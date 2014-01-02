<?php

/**
 * LICENSE: This source file is subject to Creative Commons Attribution
 * 3.0 License that is available through the world-wide-web at the following URI:
 * http://creativecommons.org/licenses/by/3.0/.  Basically you are free to adapt
 * and use this script commercially/non-commercially. My only requirement is that
 * you keep this header as an attribution to my work. Enjoy!
 *
 * Pasting stuff to pastebin..
 * <code>
 * $pb = new \Library\Pastebin;
 * 
 * $pb->setText('Text to paste..');
 *  // Set more things... //
 * 
 * $pb->run();
 * 
 * echo $pb->getUrl();
 * </code>
 * 
 * @license    http://creativecommons.org/licenses/by/3.0/
 * @package IRCBot
 * @subpackage Library
 * @author David <david@d4v1d.nl>
 */

namespace Library;


class Pastebin
{

        /**
         * The API key
         * @var string
         */
        private $_key;

        /**
         * The text to paste..
         * @var string
         */
        private $_text;

        /**
         * Name of the post
         * @var string
         */
        private $_name;

        /**
         * Expiring date..
         * @var string
         */
        private $_expire;

        /**
         * Paste format
         * @var string
         */
        private $_format;

        /**
         * 0=public 1=unlisted 2=private
         * @var string
         */
        private $_visible;

        /**
         * The curl handler.
         * @var resource
         */
        private $_curl;

        /**
         * the pastebin url.
         * @var string
         */
        private $_url;

        /**
         * Sets the API key
         * @param string $value
         */
        public function setKey( $value )
        {
                $this->_key = $value;
        }

        /**
         * Defines what we are going to paste..
         * @param string $value
         */
        public function setText( $value )
        {
                $this->_text = $value;
        }

        /**
         * The title of the paste..
         * @param string $value
         */
        public function setName( $value )
        {
                $this->_name = $value;
        }

        /**
         * The expire date
         * @param string $value
         */
        public function setExpire( $value )
        {
                $this->_expire = $value;
        }

        /**
         * The text format
         * @param string $value
         */
        public function setFormat( $value )
        {
                $this->_format = $value;
        }

        /**
         * Set the visibility
         * @param int $value
         */
        public function setVisible( $value )
        {
                $this->_visible = $value;
        }

        /**
         * Sets the curls options and posts to pastebin.com!
         */
        public function run()
        {
                $this->_curl = curl_init( 'http://pastebin.com/api/api_post.php' );

                curl_setopt( $this->_curl, CURLOPT_POST, true );
                curl_setopt( $this->_curl, CURLOPT_POSTFIELDS, 'api_option=paste
                        &api_paste_private=' . $this->_visibility . '
                        &api_paste_name=' . $this->_name . '
                        &api_paste_expire_date=' . $this->_expire . '
                        &api_paste_format=' . $this->_format . '
                        &api_dev_key=' . $this->_key . '
                        &api_paste_code=' . $this->_text . '' );

                curl_setopt( $this->_curl, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $this->_curl, CURLOPT_NOBODY, 0 );

                $this->_url = curl_exec( $this->_curl );
        }

        public function getUrl()
        {
                return $this->_url;
        }

}

?>
