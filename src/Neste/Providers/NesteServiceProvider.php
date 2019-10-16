<?php
namespace Neste\Providers;

use Neste\Generators\MigrationGenerator;
use Neste\Generators\ModelGenerator;
use Neste\Console\NesteCommand;
use Neste\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class NesteServiceProvider extends ServiceProvider {

  /**
   * Neste version
   *
   * @var string
   */
  const VERSION = '1.1.1';

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    $this->registerCommands();
  }

  /**
   * Register the commands.
   *
   * @return void
   */
  public function registerCommands() {
    $this->registerNesteCommand();
    $this->registerInstallCommand();

    // Resolve the commands with Artisan by attaching the event listener to Artisan's
    // startup. This allows us to use the commands from our terminal.
    $this->commands('command.neste', 'command.neste.install');
  }

  /**
   * Register the 'neste' command.
   *
   * @return void
   */
  protected function registerNesteCommand() {
    $this->app->singleton('command.neste', function($app) {
      return new NesteCommand;
    });
  }

  /**
   * Register the 'neste:install' command.
   *
   * @return void
   */
  protected function registerInstallCommand() {
    $this->app->singleton('command.neste.install', function($app) {
      $migrator = new MigrationGenerator($app['files']);
      $modeler  = new ModelGenerator($app['files']);

      return new InstallCommand($migrator, $modeler);
    });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
    return array('command.neste', 'command.neste.install');
  }

}
