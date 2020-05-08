<?php

namespace App\Providers;

use App\Feeders\Atom;

use Illuminate\Support\ServiceProvider;

use App\Scrapers\FeedScraper;

use App\Feeders\AtomFile;
use Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(AtomFile::class, function ($app) {


            $url = "https://www.internazionale.it/i-piu-letti";

            if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {

                echo "Not a valid url";
            } else {

                try {
                    $array = get_headers($url);
                } catch (Exception $e) {

                    dd($e);
                } finally {
                    $string = $array[0];

                    if (!strpos($string, "200")) {
                        echo 'url exists';
                    } else {


                        $myfile = fopen("newFile.atom", "w") or die("Unable to open file!");
                        $atom = new Atom();
                        $atoms = new FeedScraper($url, $atom, $myfile);
                        $atoms_array = $atoms->scraper();

                        return  new AtomFile($atoms_array, $myfile);
                    }
                }
            }
        });
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
