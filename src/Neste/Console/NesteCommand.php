<?php
namespace Neste\Console;

use Illuminate\Console\Command;
use Neste\NesteServiceProvider as Neste;

class NesteCommand extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'neste';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get Neste version notice.';

  /**
   * Execute the console command.
   *
   * @return void
   */
  public function fire() {
      $this->line('<info>Neste</info> version <comment>' . Neste::VERSION . '</comment>');
      $this->line('A Nested Set pattern implementation for the Eloquent ORM.');
      $this->line('<comment>Copyright (c) 2013 Estanislau Trepat</comment>');
  }

}
