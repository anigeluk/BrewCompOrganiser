<?php

namespace AppBundle\Twig;

use Symfony\Component\Security\Acl\Voter\FieldVote;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouterInterface;
use Homegrown\Cultivate\CoreBundle\Model\UserQuery;


use DateTime;

class TwigExtension extends \Twig_Extension
{

    private $kernel;
    private $router;

    public function __construct(Kernel $kernel, RouterInterface $router)
    {
        $this->kernel = $kernel;
        $this->router = $router;
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('percent', array($this, 'percent')),
            new \Twig_SimpleFunction('is_percent', array($this, 'isPercent')),
            new \Twig_SimpleFunction('link_if_allowed', array($this, 'linkIfAllowed'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('diff', array($this, 'diff')),
            new \Twig_SimpleFunction('date_diff', array($this, 'dateDiff')),
            new \Twig_SimpleFunction('target', array($this, 'targetHighlight'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('singletarget', array($this, 'singleTargetHighlight'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('divide', array($this, 'divide')),
            new \Twig_SimpleFunction('cachebuster', array($this, 'cachebuster')),
            new \Twig_SimpleFunction('iconClass', array($this, 'getIconClass'),array( 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('is_bundle', array($this, 'isBundle')),
            new \Twig_SimpleFunction('link', array($this, 'link'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('round_to_fraction', array($this, 'roundToFraction')),
            new \Twig_SimpleFunction('seconds_to_time', array($this, 'secondsToTime')),
            new \Twig_SimpleFunction('get_logo', array($this, 'getLogo')),
            new \Twig_SimpleFunction('get_name_for_id', array($this, 'getNameForId')),
            new \Twig_SimpleFunction('schedule', array($this, 'scheduleStyle')),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('excerpt', array($this, 'excerptFilter')),
            new \Twig_SimpleFilter('muted', array($this, 'mutedFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('highlight', array($this, 'highlightFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('money', array($this, 'moneyFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('sign', array($this, 'signFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('clean', array($this, 'cleanFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('decimal_time', array($this, 'decimalToTime'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('seconds_to_hours', array($this, 'secondsToHours')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'm2_twig';
    }

    public function mutedFilter($val, $string, $class='text-muted')
    {
        if (strlen($val) < 1) {
            return '<span class="'.$class.'">'.$string.'</span>';
        }
        return $val;
    }

    public function moneyFilter($val, $curreny='GBP')
    {
        switch ($curreny) {
            case 'GBP' :
                $symbol = '&pound;';
                break;
        }
        return $symbol.number_format($val, 2);
    }

    public function highlightFilter($val, $width=null)
    {
        if (is_numeric($val) || substr($val, -1) == '%') {
//            $class = ($val >= 0) ? ' bg-success ' : ' bg-danger ';
            $class = ($val >= 0) ? ' bg-success ' : ' ';
            $width = (null === $width) ? 'auto' : $width.'px';
            return '<span style="display:block;margin:0 auto;width:'.$width.'" class="'.$class.'">'.$val.'</span>';
        }
        return $val;
    }
    
    public function signFilter($val, $precision=0, $options=array())
    {
        if (is_numeric($val)) {
            if ($val >= 0 ) {
                $append = array_key_exists('append', $options) ? $options['append'] : '';
                return '<span style="background-color:green" class="badge">'.number_format($val, $precision).$append.'</span>';
            }       
        }
        return $val;
    }

    public function targetHighlight($top, $bottom, $precision = 0, $options = array())
    {
        $append = array_key_exists('append', $options) ? $options['append'] : '';
        $prepend = array_key_exists('prepend', $options) ? $options['prepend'] : '';
        $style = array_key_exists('text', $options) ? 'color:' : 'background-color:';
        $top_colour = array_key_exists('top-color', $options) ? $style.$options['top-color'] : 'green';
//        $bottom_color = array_key_exists('bottom-color', $options) ? $style.$options['bottom-color'] : 'red';
        $bottom_color = '';

        $top = number_format((float)$top, $precision, '.', '');
        $bottom = number_format((float)$bottom, $precision, '.', '');
        $hit = $top >= $bottom;
        if ($hit) {
            return '<span style="' . $style.$top_colour . '" class="badge">' . $prepend . $top . $append . ' / ' . $prepend . $bottom . $append . '</span>';
        }

        return '<span>' . $prepend . $top . $append . '&nbsp;/&nbsp;' . $prepend . $bottom . $append . '</span>';
    }
    
    public function singleTargetHighlight($top, $bottom, $precision = 0, $options = array())
    {
        $append = array_key_exists('append', $options) ? $options['append'] : '';
        $prepend = array_key_exists('prepend', $options) ? $options['prepend'] : '';
        $style = array_key_exists('text', $options) ? 'color:' : 'background-color:';
        $top_colour = array_key_exists('top-color', $options) ? $style.$options['top-color'] : 'green';
//        $bottom_color = array_key_exists('bottom-color', $options) ? $style.$options['bottom-color'] : 'red';
        $bottom_color = '';

        $top = number_format((float)$top, $precision, '.', '');
        $bottom = number_format((float)$bottom, $precision, '.', '');
        $hit = $top >= $bottom;
        if ($top >= $bottom) {
            return '<span style="' . $style.$top_colour . '" class="badge">' . $prepend . $top . $append . '</span>';
        }

        return '<span>' . $prepend . $top . $append . '</span>';
    }

    public function percent($top, $bottom, $point = 2, $default = 0)
    {
        return ($bottom > 0 ? number_format(($top / $bottom) * 100, $point)  : $default) . '%';
    }

    /**
     * Check if a given value is a number between 0 and 100
     * @param type $value
     * @return boolean
     */
    public function isPercent($value = false)
    {
        if (!is_numeric($value))
            return false;

        if ($value > 100 || $value < 0)
            return false;

        return true;
    }
    /**
     * If role is allowed return a link to $path with $text as the anchor eolse return just $text
     * @param type $role
     * @param type $path
     * @param type $text
     * @return string
     */
    public function linkIfAllowed($role, $path, $text, $object = null, $field = null)
    {
        if (!$this->isAllowed($role))
            return $text;

        return "<a href='".$path."'>".$text."</a>";
    }

    /**
     * Find out if a bundle exists
     * @param string $bundle
     * @return boolean
     */
    public function isBundle($search, $object = null, $field = null)
    {
        $bundles = $this->kernel->getBundles();
        foreach($bundles as $bundle)
        {
            if ($bundle->getName() == $search)
                return true;
        }

        return false;

    }

    public function dateDiff($date1, $date2)
    {
        if (!$date1 instanceof \Datetime) {
            $date1 = new \DateTime($date1);
        }
        if (!$date2 instanceof \Datetime) {
            $date2 = new \DateTime($date2);
        }
        
        $diff = $date1->diff($date2);
        
        return $diff->format('%H:%I:%s');
    }

    public function excerptFilter($string, $length = 50, $more = '...')
    {
        if (strlen($string) > $length)
            return substr($string, 0, $length) . $more;
        else
            return $string;
    }

    public function divide($top, $bottom, $point = null, $default = 0)
    {
        if ($point) {
            return $bottom > 0 ? number_format($top / $bottom, $point) : $default;
        } else {
            return $bottom > 0 ? $top / $bottom : $default;
        }
    }


    /**
     * Simple cache buster will append the modification time of this file as a parameter
     * As we create new files on every release this will force the browser to download the
     * new css or js file every release.
     * use : <script src="/js/general.js{{cachebuster()}}"></script>
     * result : <script src="/js/general.js?v=1412330032"></script>
     * @return string
     */
    public function cachebuster()
    {
        $time = filemtime(__FILE__);
        return ("?v=".$time);
    }


    /**
     * Display a glyphicon from the  icon set
     * @param string $name
     * @param string $class Optional class name to include in class declaration
     * @return string
     */
    public function getIconClass($name, $class = "")
    {
        return '<i class="'.$class.' glyphicon glyphicon-'.$name.'"></i>';
    }

    public function pluralize( $count, $text )
    {
        return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
    }

    public function diff( $datetime )
    {
        $interval = date_create('now')->diff( $datetime );
        $suffix = ( $interval->invert ? ' ago' : '' );
        if ( $v = $interval->y >= 1 ) return $this->pluralize( $interval->y, 'year' ) . $suffix;
        if ( $v = $interval->m >= 1 ) return $this->pluralize( $interval->m, 'month' ) . $suffix;
        if ( $v = $interval->d >= 1 ) return $this->pluralize( $interval->d, 'day' ) . $suffix;
        if ( $v = $interval->h >= 1 ) return $this->pluralize( $interval->h, 'hour' ) . $suffix;
        if ( $v = $interval->i >= 1 ) return $this->pluralize( $interval->i, 'minute' ) . $suffix;
        return $this->pluralize( $interval->s, 'second' ) . $suffix;
    }

    public function link($route, $value, $default = null, $options = array())
    {
        if ($this->isAllowed($route[0])) {
            $href = $this->router->generate($route[0], isset($route[1]) ? $route[1] : array());
            return '<a href="' . $href . '"' . $this->htmlAttributes($options) . '>' . $value . '</a>';
        } else {
            return $default ? $default : $value;
        }
    }
    
    public function htmlAttributes($attributes)
    {
        $str = '';
        foreach ($attributes as $name => $value) {
            $str .= ' ' . $name . '="' . $value . '"';
        }
        return $str;
    }
    
    public function cleanFilter($string)
    {
        return preg_replace("/\W\D/i", '', $string);
    }

    /**
     * Rounds up to nearest given fraction eg (2.56,4) round to nearest quarter so 2.75
     * @param numeric $number
     * @param numeric $denominator
     * @param string $method Round , ceil or floor
     * @return numeric
     */
    public function roundToFraction($number, $denominator = 1, $method = 'round')
    {
        $x = $number * $denominator;
        if ($method == "floor")
            $x = floor($x);
        else if ($method == "ceil")
            $x = ceil($x);
        else
            $x = round($x);

        $x = $x / $denominator;
        
        return $x;
    }
    
    /*
     * Take a number of seconds and turn it into days hours:minutes:seconds
     * @param type $seconds
     * @return type
     */
    public function secondsToTime($seconds = 0)
    {
        $seconds = round($seconds);
        $from = new DateTime("@0");
        $to = new DateTime("@$seconds");
        $days = $from->diff($to)->format('%a');
        if ($days > 1)
            $results = $from->diff($to)->format('%a days, %H:%I:%S');
        elseif ($days == 1)
            $results = $from->diff($to)->format('%a day, %H:%I:%S');
        else
            $results = $from->diff($to)->format('%H:%I:%S');

        return $results;
    }


    /**
     * Get the logo based on the date
     * @return string
     */
    function getLogo()
    {
        $date = new DateTime;

        if ($date->format('m') == 10 && $date->format('d') >= 14 )
            $logo = 'halloween';
        elseif ($date->format('m') == 11 && $date->format('d') <= 5 )
            $logo = 'fireworks';
        else
            $logo = 'original';

        return $logo;
    }

    /**
     * Get users name from StaffId or return input on error
     * @return string
     */
    function getNameForId($id)
    {
        $user = UserQuery::create()
                ->findPk($id);
        if (empty($user))
            return $id;

        return $user->getName();
    }
    
    public function decimalToTime($val)
    {
        // start by converting to seconds
        $seconds = ($val * 3600);
        // we're given hours, so let's get those the easy way
        $hours = floor($val);
        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;
        // calculate minutes left
        $minutes = floor($seconds / 60);
        // return the time formatted HH:MM:SS
        return str_pad($hours, 1, 0, STR_PAD_LEFT).":".str_pad($minutes, 1, 0, STR_PAD_LEFT);
    }
    
    public function secondsToHours($val)
    {
        $hours = floor($val / 3600);
        $minutes = floor(($val / 60) % 60);
        $seconds = $val % 60;

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
    
    public function scheduleStyle($val, $shift=null)
    {
        $class = false;
        
        if (! is_numeric($val)) {
            if ('TR' == $val) {
                $class = 'cellTR';
            } else {
                $class = ($shift) ? 'cell'.$shift : 'cellAM';
            }
        }
        
        return $class;
    }
}
