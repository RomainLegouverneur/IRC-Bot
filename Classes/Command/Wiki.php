<?php
// Namespace
namespace Command;

/**
 * Returns a Wikipedia URL
 *
 * @package IRCBot
 * @subpackage Command
 * @author Terry Matula <terrymatula@gmail.com>
 */
class Wiki extends \Library\IRC\Command\Base {
        public $api_path = 'http://fr.wikipedia.org/w/api.php?action=opensearch&format=json&search=';
        public $link_path = 'http://fr.wikipedia.org/wiki/';

        /**
         * The command's help text.
         *
         * @var string
         */
        protected $help = '!wiki [term] to search Wikipedia.';

        /**
         * The number of arguments the command needs.
         *
         * @var integer
         */
        protected $numberOfArguments = -1;

        /**
         * Get Wikipedia URL and return it.
         */
        public function command() {
                if (isset($this->arguments[0]) AND !empty($this->arguments[0])) {
                        $args = implode(' ', $this->arguments);
                        $this->say($this->searchWiki($args));
                }
        }

        /**
         * Search Wikipedia
         *
         * @param  string $term
         * @return string
         */
        private function searchWiki($term) {
                $uri = $this->api_path .  urlencode(trim($term));
                $response = json_decode($this->fetch($uri));
                if ($response[1][0]) {
                        return $this->link_path . str_replace(' ', '_', $response[1][0]);
                } else {
                        return 'No Wikipedia Results Found. Loser.';
                }
        }
}
?>