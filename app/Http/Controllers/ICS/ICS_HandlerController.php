<?php

namespace App\Http\Controllers\ICS;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ICS_HandlerController extends Controller
{
    public function ics_handler(Request $request){
        
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename=Examen.ics');
        
        $ics = new ICS(array(
            'location' => "Mozartlaan 15 Zwolle",
            'description' => session('vak') . " " . session('examen'),
            'dtstart' => $request->session()->get('datum') . ' ' . $request->session()->get('tijd'),
            'dtend' => $request->session()->get('datum') . ' ' . $request->session()->get('tijd'),
            'summary' => "Examen ingepland voor " . session('studentnummer'),
            'url' => "https://deltion.nl"
        ));

        echo $ics->to_string();
        $request->session()->flush();
    }
}

class ICS {
    const DT_FORMAT = 'Ymd\THis';
  
    protected $properties = array();
    private $available_properties = array(
      'description',
      'dtend',
      'dtstart',
      'location',
      'summary',
      'url'
    );
  
    public function __construct($props) {
        date_default_timezone_set('UTC');
        $this->set($props);
    }
  
    public function set($key, $val = false) {
      if (is_array($key)) {
        foreach ($key as $k => $v) {
          $this->set($k, $v);
        }
      } else {
        if (in_array($key, $this->available_properties)) {
          $this->properties[$key] = $this->sanitize_val($val, $key);
        }
      }
    }
  
    public function to_string() {
      $rows = $this->build_props();
      return implode("\r\n", $rows);
    }
  
    private function build_props() {
      // Build ICS properties - add header
      $ics_props = array(
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'TZID:Amsterdam/Europe',
        'PRODID:-//hacksw/handcal//NONSGML v1.0//EN',
        'CALSCALE:GREGORIAN',
        'BEGIN:VEVENT'
      );
  
      // Build ICS properties - add header
      $props = array();
      foreach($this->properties as $k => $v) {
        $props[strtoupper($k . ($k === 'url' ? ';VALUE=URI' : ''))] = $v;
      }
  
      // Set some default values
      $props['DTSTAMP'] = $this->format_timestamp('now');
      $props['UID'] = uniqid();
  
      // Append properties
      foreach ($props as $k => $v) {
        $ics_props[] = "$k:$v";
      }
  
      // Build ICS properties - add footer
      $ics_props[] = 'END:VEVENT';
      $ics_props[] = 'END:VCALENDAR';
  
      return $ics_props;
    }
  
    private function sanitize_val($val, $key = false) {
      switch($key) {
        case 'dtend':
        case 'dtstamp':
        case 'dtstart':
          $val = $this->format_timestamp($val);
          break;
        default:
          $val = $this->escape_string($val);
      }
  
      return $val;
    }
  
    private function format_timestamp($timestamp) {
      $dt = new DateTime($timestamp);
      return $dt->format(self::DT_FORMAT);
    }
  
    private function escape_string($str) {
      return preg_replace('/([\,;])/','\\\$1', $str);
    }
  }
