<?php
// Namespace
namespace Command;

/**
 * Sends PHP Function Info to channel.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Humberto Pereira (https://github.com/begnini)
 *
 */
class Php extends \Library\IRC\Command\Base {
    /**
     * The command's help text.
     *
     * @var string
     */
    protected $help = '!php [function name]';

    private $url = 'http://php.net/';

    /**
     * The number of arguments the command needs.
     *
     * @var integer
     */
    protected $numberOfArguments = 1;

    /**
     * Search for PHP function data, and give response to channel
     *
     * IRC-Syntax: PRIVMSG PHP function
     */
    public function command()
    {
        $function = $this->arguments[0];
        $function = str_replace('::', '.', $function);
        
        $data     = $this->fetch($this->url . $function);

        if (preg_match('/"refpurpose">(.*)/', $data, $match)) 
        {
            $doc = new \DOMDocument();
            /* ignore HTML malformed warnings */
            @$doc->loadHTML($data);

            $ps = $doc->getElementsByTagName('p');
            
            foreach ($ps as $p)
            {
                if ($p->getAttribute('class') == 'refpurpose')
                {
                    $description = $this->getText($p);
                    break;
                }
            }

            /* send function description */
            $this->say($description);

            $divs = $doc->getElementsByTagName('div');

            $params = '';

            foreach ($divs as $div)
            {
                if ($div->getAttribute('class') == 'methodsynopsis dc-description')
                {
                    $params = $this->getText($div);
                    break;
                }
            }
                
            $this->say($params);
        }
        else
        {
            $this->say('PHP: Error fetching data');
        }
    }

    private function getText($element) 
    {
        /* get HTML from the div elem. */
        $doc = new \DOMDocument();
        $doc->appendChild($doc->importNode($element, TRUE));

        $html = $doc->saveHTML();

        /* remove html tags and extra spaces */
        $text = strip_tags($html);
        $text = str_replace('&mdash;', '-', $text);
        $text = html_entity_decode($text);

        $text = str_replace("\n", ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        return $text;
    }
}
?>
