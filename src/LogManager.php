<?php declare(strict_types=1);
namespace LogManager;
class LogManager {
    protected string $filepath;
    protected $file;
    protected bool $console_time = false;
    protected bool $console_output = false;
    public function __construct(string $filepath) { $this->filepath = $filepath; return $this; }
    protected function _open() : self { $this->file = fopen($this->filepath,"a+"); return $this; }
    public function console(bool $bool = false) : self { $this->console_output = $bool; return $this; }
    public function wln(string $message) : self { return $this->w($message."\n"); }
    public function w(string $message) : self {
        $times = date("Ymd-H:i:s",time());
        $build_message = $this->console_time ? "[{$times}] : {$message}" : $message;
        fputs($this->file,$build_message);
        $this->console_output && $this->echo($build_message);
        return $this;
    }
    public function console_time(bool $bool = false) : self { $this->console_time = $bool; return $this; }
    public function echo(string $message) : self { echo $message; return $this; }
    public function open() : self { return $this->_open(); }
    public function close() : self { fclose($this->file); return $this; }
}